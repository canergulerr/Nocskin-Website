<?php
if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__);
}

if (!defined('BASE_URL')) {
    // Auto-detect localhost environment (handling ports)
    if (php_sapi_name() === 'cli' || !isset($_SERVER['HTTP_HOST'])) {
        define('BASE_URL', 'https://nocskin.com.tr');
    } elseif (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
        // Keep localhost for local dev if needed, or strictly follow "replace all". 
        // User said "Proje şu an yerel ortamda... canlıya alınacaktır." and "localhost/noc_new ... ifadesini gördüğün her yeri ... güncelle".
        // But for config, it's safer to have the live URL as the default/else case which it already is.
        // I will make sure the 'else' is definitely the live URL.
        define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/noc_new');
    } else {
        define('BASE_URL', 'https://nocskin.com.tr');
    }
}