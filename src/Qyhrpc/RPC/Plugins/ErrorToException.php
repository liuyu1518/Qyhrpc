<?php
namespace Qyhrpc\RPC\Plugins;

use ErrorException;
use Qyhrpc\RPC\Core\Context;

class ErrorToException {
    public $error_types;
    public function __construct(int $error_types = E_ALL | E_STRICT) {
        $this->error_types = $error_types;
    }
    public function handler(string $request, Context $context, callable $next): string {
        $error_handler = set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        });
        try {
            return $next($request, $context);
        } finally {
            set_error_handler($error_handler);
        }
    }
}
