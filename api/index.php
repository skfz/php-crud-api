<?php

require '../bootstrap.php';

use Api\Request;
use Api\ClassFactory;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$request = new Request(
    $_SERVER['REQUEST_URI'],
    $_SERVER['REQUEST_METHOD']
);

$classFactory = new ClassFactory;
$className = $classFactory->getClassName($request->resourceType);

switch ($request->method) {
    case "GET":
        $resourceClass = new $className($conn);
        $response = $resourceClass->fetchResource($request->resourceId);
        break;
    case "POST":
        $resourceClass = new $className($conn);
        $response = $resourceClass->postData();
        break;
    case "DELETE":
        $resourceClass = new $className($conn);
        $response = $resourceClass->deleteResource($request->resourceId);
        break;
    case "PUT":
        $resourceClass = new $className($conn);
        $response = $resourceClass->updateData($request->resourceId);
        break;
    default: echo "Nothing to do";
        break;
}

header($response['status_code']);
if ($response['body']) {
    echo $response['body'];
}