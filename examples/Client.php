<?php
require 'vendor/autoload.php';

use Qyhrpc\RPC\Client;
use Qyhrpc\RPC\Plugins\Log;

$client = new Client(['http://127.0.0.1:8024/']);
$log = new Log();
$client->use([$log, 'invokeHandler'], [$log, 'ioHandler']);
$proxy = $client->useService();
$result = $proxy->hello('world');
print($result);