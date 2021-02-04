<?php

namespace Qyhrpc\RPC\Core;

interface ClientCodec {
    function encode(string $name, array &$args, ClientContext $context): string;
    function decode(string $response, ClientContext $context);
}