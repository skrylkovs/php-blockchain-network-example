<?php

spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/src/'; // Указываем базовую папку

    $file = $baseDir . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        echo 'file: ' . $file . PHP_EOL;
        require_once $file;
    }
});