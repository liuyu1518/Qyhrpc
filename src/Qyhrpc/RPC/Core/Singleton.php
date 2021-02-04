<?php

namespace Qyhrpc\RPC\Core;

trait Singleton {
    private static $instance = null;
    public static function getInstance() {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}