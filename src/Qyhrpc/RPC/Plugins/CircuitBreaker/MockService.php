<?php

namespace Qyhrpc\RPC\Plugins\CircuitBreaker;

use Qyhrpc\RPC\Core\Context;

interface MockService {
    function invoke(string $name, array &$args, Context $context);
}