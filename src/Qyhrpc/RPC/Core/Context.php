<?php
namespace Qyhrpc\RPC\Core;

use ArrayAccess;

class Context implements ArrayAccess {
    public $requestHeaders = [];
    public $responseHeaders = [];
    protected $items = [];
    public function __set(string $name, $value): void {
        $this->items[$name] = $value;
    }
    public function __get(string $name) {
        return isset($this->items[$name]) ? $this->items[$name] : null;
    }
    public function __isset(string $name): bool {
        return isset($this->items[$name]);
    }
    public function __unset(string $name): void {
        unset($this->items[$name]);
    }
    public function offsetSet($name, $value) {
        $this->items[$name] = $value;
    }
    public function offsetGet($name) {
        return isset($this->items[$name]) ? $this->items[$name] : null;
    }
    public function offsetExists($name) {
        return isset($this->items[$name]);
    }
    public function offsetUnset($name) {
        unset($this->items[$name]);
    }
    public function getItems(): array{
        return $this->items;
    }
}