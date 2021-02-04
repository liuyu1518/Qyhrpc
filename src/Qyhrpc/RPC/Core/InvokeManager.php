<?php

namespace Qyhrpc\RPC\Core;

class InvokeManager extends PluginManager {
    protected function getNextHandler(callable $handler, callable $next): callable {
        return function (string $name, array &$args, Context $context) use ($handler, $next) {
            return call_user_func_array($handler, [$name, &$args, $context, $next]);
        };
    }
}