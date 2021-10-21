<?php

require('Helper.php');


class SoundCloudParser {
    public $baseHost;
    public $apiHost;

    private $clientId;

    public function __construct($config) {
        $this->baseHost = $config['base_host'];
        $this->apiHost  = $config['api_host'];
        $this->clientId = $config['client_id'];
    }

    public function getArtistTracks($artistId) {
        return $this->apiRequest('users/'.$artistId.'/tracks')['collection'];
    }

    public function getArtistInfo($artistId) {
        return $this->apiRequest('users/'.$artistId);
    }

    public function getArtistID($artistName) {
        // жесть, согласен, но другого способа не нашёл)
        $artistPage = $this->baseRequest($artistName);
        return Helper::getStringBetween($artistPage, '"soundcloud:users:', '"');
    }

    private function request($url, $options=false) {
        $ch = curl_init();

        if ($options) {
            $queryString = http_build_query($options);
            $url = $url . '?' . $queryString;
        }

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        if (curl_error($ch)) {
            echo 'Request error: '. curl_error($ch);
            die();
        }

        return $result;
    }

    private function baseRequest($url, $options=false) {
        $url = $this->baseHost . '/' . $url;
        return $this->request($url, $options);
    }

    private function apiRequest($url, $options=[]) {
        $url = $this->apiHost . '/' . $url;
        $options['client_id'] = $this->clientId;
        $response = $this->request($url, $options);
        if ($response) {
            return json_decode($response, true);
        }
        return false;
    }
}