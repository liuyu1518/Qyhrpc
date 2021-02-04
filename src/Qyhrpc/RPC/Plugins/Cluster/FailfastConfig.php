<?php

namespace Qyhrpc\RPC\Plugins\Cluster;

class FailfastConfig extends ClusterConfig {
    public $retry = 0;
    public function __construct(callable $onFailure) {
        $this->onFailure = $onFailure;
    }
}