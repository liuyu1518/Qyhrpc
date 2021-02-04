<?php

namespace Qyhrpc\RPC;

class_alias('Qyhrpc\\RPC\\Core\\Client', 'Qyhrpc\\RPC\\Client');

if (!Client::isRegister('mock')) {
    Client::register('mock', 'Qyhrpc\\RPC\\Mock\\MockTransport');
}
if (!Client::isRegister('http')) {
    Client::register('http', 'Qyhrpc\\RPC\\Http\\HttpTransport');
}
