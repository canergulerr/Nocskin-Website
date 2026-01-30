<?php
if (!function_exists('get_header')) {
    function get_header()
    {
        // Assuming header.php is in the root directory relative to where this script is included
        // or usage of global constants if available.
        if (file_exists(__DIR__ . '/../header.php')) {
            include __DIR__ . '/../header.php';
        } elseif (file_exists('header.php')) {
            include 'header.php';
        }
    }
}

if (!function_exists('get_footer')) {
    function get_footer()
    {
        if (file_exists(__DIR__ . '/../footer.php')) {
            include __DIR__ . '/../footer.php';
        } elseif (file_exists('footer.php')) {
            include 'footer.php';
        }
    }
}

if (!function_exists('_e')) {
    function _e($text, $domain = 'default')
    {
        echo $text;
    }
}

if (!function_exists('get_template_directory_uri')) {
    function get_template_directory_uri()
    {
        return defined('BASE_URL') ? BASE_URL : '';
    }
}
?>