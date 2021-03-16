<?php

namespace Api;
use \PDO;

class Database {
    /**
     * @var PDO
     */
    private $db = null;

    /**
     * @var string
     */
    protected $dsn = null;

    /**
     * @var string
     */
    protected $host = null;

    /**
     * @var integer
     */
    protected $port = null;

    /**
     * @var string
     */
    protected $dbname = null;

    /**
     * @var string
     */
    protected $dbuser = null;

    /**
     * @var string
     */
    protected $dbpwd = null;

    /**
     * @var array
     */
    protected $attributes = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    public function __construct($config) {
        $this->dsn = $config['dsn'];
        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->dbname = $config['dbname'];
        $this->dbuser = $config['dbuser'];
        $this->dbpwd = $config['dbpwd'];
    }

    public function connect() {
        return $this->getConnection();
    }

    /**
     * @return PDO
     */
    final protected function getConnection() {
        if ($this->db == null) {
            try {
                $this->db = new PDO(
                    sprintf("%s:host=%s;port=%s;dbname=%s", $this->dsn, $this->host, $this->port, $this->dbname),
                    $this->dbuser, $this->dbpwd);
            } catch (\PDOException $e) {
                exit($e->getMessage());
            }
        }
        return $this->db;
    }
}