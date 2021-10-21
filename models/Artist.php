<?php

require_once('SCDBModel.php');

class Artist extends SCDBModel {
    protected $tableName   = 'artists';
    protected $uniqueField = 'sc_id';

    public $fields = [
        'sc_id',
        'user_name',
        'name',
        'city',
        'first_name',
        'last_name',
        'link',
        'description',
        'followers_count',
        'playlists_count',
        'tracks_count',
    ];
}