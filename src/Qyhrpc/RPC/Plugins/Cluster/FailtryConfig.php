<?php

namespace Qyhrpc\RPC\Plugins\Cluster;

class FailtryConfig extends ClusterConfig {
    use Singleton;
    public function __construct(int $retry = 10, float $minInterval = 0.5, float $maxInterval = 5.0) {
        $this->retry = $retry;
        $this->onRetry = function (Context $context): float {
            $interval = (++$context->retried) * $minInterval;
            if ($interval > $maxInterval) {
                $interval = $maxInterval;
            }
            return $interval;
        };
    }
}