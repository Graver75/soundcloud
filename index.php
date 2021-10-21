<?php

require('SCWebDriver.php');
require('SCDBDriver.php');

require('models/Artist.php');
require('models/Track.php');

$config = include('config.php'); // в конфиг прокинуть db юзера надо и юзернеймы исполнителей

$webdriver = new SCWebDriver($config);
$dbDriver  = new SCDBDriver($config); // тут в файле лежит команда для создания базы

$artists   = $config['artists'];

foreach ($artists as $artist) {
    $artistId    = $webdriver->getArtistID($artist);
    $artistInfo  = $webdriver->getArtistInfo($artistId);

    $artistModel = new Artist($dbDriver->getDriver());
    if (!$artistModel->isExists($artistInfo)) {
        $artistModel->insert([
            $artistInfo['id'],
            $artistInfo['permalink'],
            $artistInfo['username'],
            $artistInfo['city'],
            $artistInfo['first_name'],
            $artistInfo['last_name'],
            $artistInfo['permalink_url'],
            $artistInfo['description'],
            $artistInfo['followers_count'],
            $artistInfo['playlist_count'],
            $artistInfo['track_count'],
        ]);
    }


    $tracks = $webdriver->getArtistTracks($artistId);
    foreach ($tracks as $trackInfo) {
        $trackModel = new Track($dbDriver->getDriver()); // запросы в цикле плохо, но "драйвер" для бд самописный))
        if (!$trackModel->isExists($trackInfo)) {
            $trackModel->insert([
                $trackInfo['id'],
                $trackInfo['title'],
                $trackInfo['duration'],
                $trackInfo['likes_count'],
                $artistInfo['id'],
                $trackInfo['comment_count'],
                $trackInfo['playback_count']
            ]);
        }
    }
}