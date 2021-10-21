<?php

require_once('SCDBModel.php');

class Track extends SCDBModel {
    protected $tableName   = 'tracks';
    protected $uniqueField = 'sc_id';

    public $fields = [
        'sc_id',
        'title',
        'duration',
        'likes_count',
        'artist_id',
        'comment_count',
        'playback_count'
    ];
}