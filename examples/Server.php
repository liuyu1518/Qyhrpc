<?php
require 'vendor/autoload.php';

use Qyhrpc\RPC\Http\HttpServer;
use Qyhrpc\RPC\Service;

function hello(string $name): string {
    return "Hello " . $name . "!";
}

$service = new Service();
$service->addCallable("hello", "hello");
$server = new HttpServer();
$service->bind($server);
$server->listen();