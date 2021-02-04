<?php

namespace Qyhrpc\RPC\Http;

class HttpResponse {
    public $headers = [];
    public function end(int $code = 200, string $data = ''): void {
        http_response_code($code);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $data;
    }
}