<?php

namespace Qyhrpc\RPC\Core;

interface Transport {
    function transport(string $request, Context $context): string;
    function abort(): void;
}