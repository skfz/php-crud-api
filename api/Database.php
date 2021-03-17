<?php

namespace Api;
use \PDO;
use Api\Model\Database as DatabaseModel;

class Database {
    /**
     * @var PDO
     */
    private $db = null;

    /**
     * @var array
     */
    protected $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    /**
     * @var object
     */
    protected $config = null;

    public function __construct(DatabaseModel $config) {
        $this->config = $config;
    }

    public function connect() {
        return $this->getConnection();
    }

    /**
     * @return PDO
     */
    private function getConnection() {
        if ($this->db == null) {
            try {
                $this->db = new PDO(
                    sprintf("%s:host=%s;port=%s;dbname=%s", $this->config->dsn, $this->config->host, $this->config->port, $this->config->dbname),
                    $this->config->dbuser, $this->config->dbpwd);
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }
        }
        return $this->db;
    }
}