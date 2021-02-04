<?php

namespace Qyhrpc\RPC\Plugins;

use Qyhrpc\RPC\Client;
use Qyhrpc\RPC\Core\ClientContext;
use Qyhrpc\RPC\Core\Context;

class Forward {
    public $client;
    public $timeout = null;
    public function __construct(?array $urilist = null) {
        $this->client = new Client($urilist);
    }
    public function ioHandler(string $request, Context $context, callable $next): string {
        $clientContext = new ClientContext();
        $clientContext->timeout = $this->timeout;
        $clientContext->init($this->client);
        return $this->client->request($request, $clientContext);
    }
    public function invokeHandler(string $name, array &$args, Context $context, callable $next) {
        $clientContext = new ClientContext();
        $clientContext->timeout = $this->timeout;
        $clientContext->requestHeaders = $context->requestHeaders;
        $result = $this->client->invoke($fullname, $args, $clientContext);
        $context->responseHeaders = $clientContext->responseHeaders;
        return $result;
    }
    public function use (callable ...$handlers): self {
        $this->client->use(...$handlers);
        return $this;
    }
    public function unuse(callable ...$handlers): self {
        $this->client->unuse(...$handlers);
        return $this;
    }
}
