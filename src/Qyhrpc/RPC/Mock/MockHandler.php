<?php

namespace Qyhrpc\RPC\Mock;

use Exception;
use Qyhrpc\RPC\Core\Handler;
use Qyhrpc\RPC\Core\Service;
use Qyhrpc\RPC\Core\ServiceContext;

class MockHandler implements Handler {
    public static $serverTypes = ['Qyhrpc\\RPC\\Mock\\MockServer'];
    public $service;
    public function __construct(Service $service) {
        $this->service = $service;
    }
    public function bind($server): void {
        MockAgent::register($server->address, [$this, 'handler']);
    }
    public function handler(string $address, string $request): string {
        if (strlen($request) > $this->service->maxRequestLength) {
            throw new Exception('Request entity too large');
        }
        $context = new ServiceContext($this->service);
        $addressInfo = [
            'family' => 'mock',
            'address' => $address,
            'port' => 0,
        ];
        $context->remoteAddress = $addressInfo;
        $context->localAddress = $addressInfo;
        $context->handler = $this;
        return $this->service->handle($request, $context);
    }
}
