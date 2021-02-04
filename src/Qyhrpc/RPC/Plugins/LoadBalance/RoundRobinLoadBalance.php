<?php

namespace Qyhrpc\RPC\Plugins\LoadBalance;

use Qyhrpc\RPC\Core\Context;

class RoundRobinLoadBalance {
    private $index = -1;
    public function handler(string $request, Context $context, callable $next): string {
        $uris = $context->client->getUris();
        $n = count($uris);
        if ($n > 1) {
            $this->index = ($this->index + 1) % $n;
            $context->uri = $uris[$this->index];
        }
        return $next($request, $context);
    }
}