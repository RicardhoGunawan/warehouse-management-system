<?php
// Simpan sebagai config/path.php

define('ROOT_DIR', dirname(__DIR__));
define('APP_DIR', ROOT_DIR . '/app');
define('VIEW_DIR', APP_DIR . '/views');
define('PUBLIC_DIR', ROOT_DIR . '/public');

function includeView($path) {
    $fullPath = VIEW_DIR . '/' . ltrim($path, '/');
    if (file_exists($fullPath)) {
        include $fullPath;
    } else {
        throw new Exception("View file not found: " . $path);
    }
}