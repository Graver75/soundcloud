<?php

class SCDBDriver {
    private $dbn;

    public function __construct($config) {
        $this->dbn = new PDO(
            'mysql:host='.$config['db_host'].';dbname='.$config['db_name'], $config['db_user'], $config['db_pass']
        );
        return true;
    }

    public function getDriver() {
        return $this->dbn;
    }

}