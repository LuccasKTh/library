<?php

spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/app/';

    // Função recursiva para buscar o arquivo em subdiretórios
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base_dir));

    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getFilename() === $class . '.php') {
            include $file->getPathname();
            return;
        }
    }
});
