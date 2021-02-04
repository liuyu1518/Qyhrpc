<?php

namespace Qyhrpc\RPC\Core;

interface Handler {
    function bind($server): void;
}
