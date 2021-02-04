<?php

// Autoload for non-composer applications
spl_autoload_register(function ($className) {
    if ((strlen($className) > 7) && (strtolower(substr($className, 0, 7)) === "qyhrpc\\")) {
        $file = __DIR__ . DIRECTORY_SEPARATOR . str_replace("\\", DIRECTORY_SEPARATOR, $className) . ".php";
        if (is_file($file)) {
            include $file;
            return true;
        }
    }
    return false;
});
