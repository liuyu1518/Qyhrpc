<?php

namespace Qyhrpc\RPC\Plugins\LoadBalance;

use Qyhrpc\RPC\Core\Context;

class RandomLoadBalance {
    public function handler(string $request, Context $context, callable $next): string {
        $uris = $context->client->getUris();
        $n = count($uris);
        $context->uri = $uris[random_int(0, $n - 1)];
        return $next($request, $context);
    }
}