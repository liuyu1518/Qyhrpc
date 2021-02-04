<?php

namespace Qyhrpc\RPC\Mock;

class MockServer {
    public $address;
    public function __construct(string $address) {
        $this->address = $address;
    }
    public function close() {
        MockAgent::cancel($this->address);
    }
}