<?php
    function getDB() {
        $config = require_once '../db/config.php';
        
        return new PDO("mysql:host={$config['db']['host']}; dbname={$config['db']['name']}", $config['db']['user'], $config['db']['pass']);
    };
