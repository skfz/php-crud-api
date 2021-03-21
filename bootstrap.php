<?php

require 'vendor/autoload.php';

use Dotenv\Dotenv;
use Api\Database;
use Api\Model\Database as DatabaseModel;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbConfig = new DatabaseModel;
$dbConfig->dsn = $_ENV['DB_CONNECTION'];
$dbConfig->host = $_ENV['DB_HOST'];
$dbConfig->port = $_ENV['DB_PORT'];
$dbConfig->dbname = $_ENV['DB_NAME'];
$dbConfig->dbuser = $_ENV['DB_USERNAME'];
$dbConfig->dbpwd = $_ENV['DB_PASSWORD'];

$dbConnection = new Database($dbConfig);
$conn = $dbConnection->connect();
