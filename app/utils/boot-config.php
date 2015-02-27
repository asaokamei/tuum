<?php

use Tuum\Web\Web;
use Tuum\Web\Application;

/**
 * set up a default configuration. 
 *
 * @param array $config
 * @return Application
 */
return function( array $config ) use($boot) {

    /**
     * default configuration.
     */

    $app_root       = dirname(__DIR__);
    $project_root   = dirname($app_root);
    $default_config = [
        'routes'          => $app_root . '/routes.php',
        Web::CONFIG_DIR   => $app_root . '/config',
        Web::TEMPLATE_DIR => $app_root . '/views',
        Web::DOCUMENT_DIR => $app_root . '/docs',
        Web::VAR_DATA_DIR => $project_root . '/var',
        Web::DEBUG        => false,
    ];
    $config += $default_config;

    /*
     * build $boot.
     */
    return $boot($config);
};