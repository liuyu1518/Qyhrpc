<?php

namespace Qyhrpc\RPC\Plugins\CircuitBreaker;

use Qyhrpc\RPC\Core\Context;
use Throwable;

class CircuitBreaker {
    private $lastFailTime = 0;
    private $failCount = 0;
    public $threshold;
    public $recoverTime;
    public $mockService;
    public function __construct(int $threshold = 5, int $recoverTime = 30, ?MockService $mockService = null) {
        $this->threshold = $threshold;
        $this->recoverTime = $recoverTime;
        $this->mockService = $mockService;
    }
    public function ioHandler(string $request, Context $context, callable $next): string {
        if ($this->failCount > $this->threshold) {
            $interval = time() - $this->lastFailTime;
            if ($interval < $this->recoverTime) {
                throw new BreakerException('Service breaked');
            }
            $this->failCount = $this->threshold >> 1;
        }
        try {
            $response = $next($request, $context);
            $this->failCount = 0;
            return $response;
        } catch (Throwable $e) {
            ++$this->failCount;
            $this->lastFailTime = time();
            throw $e;
        }
    }
    public function invokeHandler(string $name, array &$args, Context $context, callable $next) {
        if ($this->mockService === null) {
            return $next($name, $args, $context);
        }
        try {
            return $next($name, $args, $context);
        } catch (BreakerException $e) {
            return $this->mockService->invoke($name, $args, $context);
        }
    }
}