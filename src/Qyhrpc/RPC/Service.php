<?php

namespace Qyhrpc\RPC;

class_alias('Qyhrpc\\RPC\\Core\\Service', 'Qyhrpc\\RPC\\Service');

if (!Service::isRegister('mock')) {
    Service::register('mock', 'Qyhrpc\\RPC\\Mock\\MockHandler');
}
if (!Service::isRegister('http')) {
    Service::register('http', 'Qyhrpc\\RPC\\Http\\HttpHandler');
}
