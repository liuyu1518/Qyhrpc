<?php

namespace Qyhrpc\RPC\Plugins\LoadBalance;

use Qyhrpc\RPC\Core\Context;
use InvalidArgumentException;

abstract class WeightedLoadBalance {
    protected $uris = [];
    protected $weights = [];
    public function __construct(array $uriList) {
        if (empty($uriList)) {
            throw new InvalidArgumentException('uriList cannot be empty');
        }
        foreach ($uriList as $uri => $weight) {
            $this->uris[] = $uri;
            if ($weight <= 0) {
                throw new InvalidArgumentException('weight must be great than 0');
            }
            $this->weights[] = $weight;
        }
    }
    public abstract function handler(string $request, Context $context, callable $next): string;
}