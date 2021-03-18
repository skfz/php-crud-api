<?php

namespace Api\Model;

class Database {
    /**
     * @var string
     */
    public string $dsn;

    /**
     * @var string
     */
    public string $host;

    /**
     * @var integer
     */
    public int $port;

    /**
     * @var string
     */
    public string $dbname;

    /**
     * @var string
     */
    public string $dbuser;

    /**
     * @var string
     */
    public string $dbpwd;
}