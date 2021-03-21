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

$resourceClass = ClassFactory::getClassName($request->resourceType);

switch ($request->method) {
    case "GET":
        return new $resourceClass->fetchResource($request->resourceId);
    case "POST":
        return new $resourceClass->postData();
    case "DELETE":
        return new $resourceClass->deleteResource($request->resourceId);
    case "PUT":
        return new $resourceClass->updateData($request->resourceId);
    default: echo "Nothing to do";
        break;
}
