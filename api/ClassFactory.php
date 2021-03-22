<?php

namespace Api;

class ClassFactory {

    /**
     * @var array
     */
    private array $validResources;

    public function __construct() {
        $this->validResources = include('config/resources.php');
    }

    /**
     * @param string
     * @return string
     */
    public function getClassName($type) {
        $type = ucwords($type);
        if (!in_array($type, $this->validResources)) {
            header("HTTP/1.1 404 Not found");
            exit();
        }
        $controller = "Api\\Controller\\" . $type . "Controller";
        return $controller;
    }
}