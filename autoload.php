<?php

function autoload ($className) {
    $className = ltrim($className, '\\');
    $filename = '';
    $namespace = '';

    if ($lastNsPos = strpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $filename = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }

    $filename.= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    if (file_exists($filename)) {
        require_once $filename;
        return true;
    }

    return false;
}

spl_autoload_register('autoload');