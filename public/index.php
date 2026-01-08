<?php

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

// Initialization

$request = ServerRequestFactory::fromGlobals();

// Action

$path = $request->getUri()->getPath();

if ($path === '/') {
    $name = $request->getQueryParams()['name'] ?? 'Guest';
    $response = new HtmlResponse('Hello, ' . $name . '!');
} elseif ($path === '/about') {
    $response = new HtmlResponse('I am a simple site');
} else {
    $response = new JsonResponse(['error' => 'Undefined page'], 404);
}


// Postprocessing

$response = $response->withHeader('X-Developer', 'ElisDN');

// Sending

$emitter = new SapiEmitter();
$emitter->emit($response);