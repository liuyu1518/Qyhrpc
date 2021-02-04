<?php

namespace Qyhrpc\RPC\Mock;

use Exception;

class MockAgent {
    private static $handlers = [];
    public static function register(string $address, callable $handler): void {
        self::$handlers[$address] = $handler;
    }
    public static function cancel(string $address): void {
        unset(self::$handlers[$address]);
    }
    public static function handler(string $address, string $request): string {
        $handler = self::$handlers[$address];
        if (isset($handler)) {
            return call_user_func($handler, $address, $request);
        }
        throw new Exception('Server is stopped');
    }
}