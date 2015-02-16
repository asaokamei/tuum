<?php

/**
 * returns configuration array.
 *
 * @return array
 */

use Tuum\Web\App;

return [

    /*
     * config directory.
     */
    App::CONFIG_DIR => __DIR__.'/config',

    /*
     * view/template directory.
     */
    App::TEMPLATE_DIR  => __DIR__.'/views',

    /*
     * document/resource directory.
     */
    App::DOCUMENT_DIR   => __DIR__.'/docs',

    /*
     * variables (cache, logs, etc.) directory.
     */
    App::VAR_DATA_DIR    => dirname(__DIR__).'/var',

    /*
     * debug is on (true) or off (false).
     */
    App::DEBUG  => false,

    /*
     * routes files
     */
    'routes' => [
        __DIR__.'/routes.php',
        __DIR__.'/route-tasks.php',
    ],
    
    /*
     * xh-profiler limit time
     */
    'xhprof-limit' => '1.0',
];
