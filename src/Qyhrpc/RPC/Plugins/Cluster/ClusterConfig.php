<?php

namespace Qyhrpc\RPC\Plugins\Cluster;

class ClusterConfig {
    public $retry = 10;
    public $idempotent = false;
    // function onSuccess(Context context): void
    public $onSuccess;
    // function onFailure(Context context): void
    public $onFailure;
    // function onRetry(Context context): int
    public $onRetry;
}