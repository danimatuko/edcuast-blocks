<?php

/*
Plugin Name: Educast Blocks
Description: A WordPress plugin to add custom Gutenberg blocks for the Educast platform.
Version: 1.0
Author: Dani Matuko
License: GPL2
*/

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

define('EDUCAST_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Autoload all PHP files in the includes directory
function educast_autoload_files($path)
{
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            include_once $file->getRealPath();
        }
    }
}

// Autoload all files in the `includes` directory
educast_autoload_files(EDUCAST_PLUGIN_DIR . 'includes');

// Initialize plugin functionality.
function educast_blocks_init()
{
    add_action('init', 'educast_blocks_register_blocks');
}

// Hook initialization function to `plugins_loaded`.
add_action('plugins_loaded', 'educast_blocks_init');
