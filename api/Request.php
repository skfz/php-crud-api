<?php

namespace Api;

class Request {

    /**
     * @var string
     */
    private ?string $request = null;

    /**
     * @var string
     */
    public ?string $method = null;

    /**
     * @var integer
     */
    public ?int $resourceId = null;

    /**
     * @var string
     */
    public ?string $resourceType = null;

    /**
     * @var array
     */
    private array $allowedMethods = ["GET", "POST", "DELETE", "PUT"];
    
    public function __construct($request, $method) {
        $this->request = $request;
        $this->method = $method;

        $uri = $this->parseURL();

        if (isset($uri[2])) {
            $this->resourceType = $uri[2];
        }

        if (isset($uri[3])) {
            $this->resourceId = intval($uri[3]);
        }
    }

    /**
     * @return array
     */
    public function parseURL() {
        $uri = explode('/', parse_url($this->request, PHP_URL_PATH));
        
        if ($uri[1] !== "api" && (!preg_match('[a-z]', $uri[2]))) {
            header("HTTP/1.1 404 Not found");
            exit();
        }

        if (!in_array($this->method, $this->allowedMethods)) {
            $this->method = null;
            header("HTTP/1.1 405 Method not allowed");
            exit();
        }

        return $uri;
    }
}