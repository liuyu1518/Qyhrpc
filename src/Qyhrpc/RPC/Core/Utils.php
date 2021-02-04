<?php

namespace Qyhrpc\RPC\Core;

use ReflectionFunction;
use ReflectionFunctionAbstract;
use ReflectionMethod;

class Utils {
    public static function getReflectionCallable(callable $callable): ReflectionFunctionAbstract {
        if (is_array($callable)) {
            return new ReflectionMethod($callable[0], $callable[1]);
        }
        if (is_string($callable) && strpos($callable, '::') !== false) {
            return new ReflectionMethod($callable);
        }
        return new ReflectionFunction($callable);
    }
    public static function getNumberOfParameters(callable $callable): int {
        return static::getReflectionCallable($callable)->getNumberOfParameters();
    }
}
