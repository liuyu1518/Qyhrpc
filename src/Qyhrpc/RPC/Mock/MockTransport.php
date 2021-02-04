<?php

namespace Qyhrpc\RPC\Mock;

use Qyhrpc\RPC\Core\Context;
use Qyhrpc\RPC\Core\TimeoutException;
use Qyhrpc\RPC\Core\Transport;

class MockTransport implements Transport {
    public static $schemes = ['mock'];
    public function transport(string $request, Context $context): string {
        $uri = parse_url($context->uri);
        $timeout = $context->timeout;
        if ($timeout > 0) {
            $async = pcntl_async_signals();
            try {
                pcntl_async_signals(true);
                pcntl_signal(SIGALRM, function () {
                    throw new TimeoutException('timeout');
                });
                pcntl_alarm($timeout);
                return MockAgent::handler($uri['host'], $request);
            } finally {
                pcntl_alarm(0);
                pcntl_async_signals($async);
            }
        } else {
            return MockAgent::handler($uri['host'], $request);
        }
    }
    public function abort(): void {}
}
