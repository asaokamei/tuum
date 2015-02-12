<?php

/**
 * returns configuration array.
 *
 * @return array
 */

return [

    /*
     * config directory.
     */
    'config' => __DIR__.'/config',

    /*
     * view/template directory.
     */
    'views'  => __DIR__.'/views',

    /*
     * document/resource directory.
     */
    'docs'   => __DIR__.'/docs',

    /*
     * variables (cache, logs, etc.) directory.
     */
    'var'    => dirname(__DIR__).'/var',

    /*
     * debug is on (true) or off (false).
     */
    'debug'  => false,

    /*
     * routes files
     */
    'routes' => [
        __DIR__.'/routes.php',
        __DIR__.'/route-tasks.php',
    ],
];
