<?php

namespace Qyhrpc\RPC\Core;

interface ServiceCodec {
    function encode($result, ServiceContext $context): string;
    function decode(string $request, ServiceContext $context): array;
}