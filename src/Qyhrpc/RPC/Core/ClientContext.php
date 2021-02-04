<?php

namespace Qyhrpc\RPC\Core;

class ClientContext extends Context {
    public function __construct(?array $items = null) {
        if ($items === null) {
            return;
        }
        $this->items = $items;
    }
    public function init(Client $client) {
        $this->client = $client;
        $uris = $client->getUris();
        if (count($uris) > 0) {
            $this->uri = $uris[0];
        }
        if (!isset($this->timeout)) {
            $this->timeout = $client->timeout;
        }
        $this->requestHeaders = array_merge($this->requestHeaders, $client->requestHeaders);
    }
}