<?php

namespace Qyhrpc\RPC\Core;

class ServiceContext extends Context {
    public $service;
    public function __construct(Service $service) {
        $this->service = $service;
    }
}