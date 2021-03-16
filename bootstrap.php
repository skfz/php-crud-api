<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Api\Database;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbConfig = [
    'dsn' => $_ENV['DB_CONNECTION'],
    'host' => $_ENV['DB_HOST'],
    'port' => $_ENV['DB_PORT'],
    'dbname' => $_ENV['DB_NAME'],
    'dbuser' => $_ENV['DB_USERNAME'],
    'dbpwd' => $_ENV['DB_PASSWORD']
];

$dbConnection = new Database($dbConfig);

