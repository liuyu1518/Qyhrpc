<?php

namespace Qyhrpc\RPC\Core;

class IOManager extends PluginManager {
    protected function getNextHandler(callable $handler, callable $next): callable {
        return function (string $request, Context $context) use ($handler, $next) {
            return call_user_func($handler, $request, $context, $next);
        };
    }
}