<?php

use Framework\Http\Request;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$request = new Request($_GET, $_POST);

$name = ucfirst($request->getQueryParams()['name']) ?? 'Guest';

header('X-Developer: suck');
echo 'Hello, ' . $name . PHP_EOL;