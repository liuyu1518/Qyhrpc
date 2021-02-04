<?php

namespace Qyhrpc\RPC\Http;

use Qyhrpc\RPC\Core\Singleton;

class HttpServer {
    use Singleton;
    private $handler;
    public $address;
    public $port;
    public function __construct() {
        $this->address = $_SERVER['SERVER_ADDR'] ?? '';
        $this->port = $_SERVER['SERVER_PORT'] ?? 80;
    }
    public function onRequest(callable $handler): void {
        $this->handler = $handler;
    }
    public function listen(): void {
        call_user_func($this->handler, new HttpRequest($this), new HttpResponse());
    }
    public function close(): void {}
}