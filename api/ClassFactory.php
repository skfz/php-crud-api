<?php

namespace Api;

require_once 'config/resources.php';

class ClassFactory {

    /**
     * @var array
     */
    private array $validResources;

    public function __construct() {
        $this->validResources = $resources;
    }

    public function getClassName($type) {
        $type = ucwords($type);
        if (!in_array($type, $this->validResources)) {
            header("HTTP/1.1 404 Not found");
            exit();
        }
        return new $type;
    }
}