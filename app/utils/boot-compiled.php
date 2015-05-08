<?php

/**
 * function to pre-process before booting a web application.
 * $boot must exist.
 *
 * @param array $config
 */
return function(array $config) {

    $debug   = $config['debug'];
    $vars_dir = $config['vars_dir'];
    if($debug) {
        return;
    }
    $compiled = $vars_dir.'/compiled.php';
    if(file_exists($compiled)) {
        /** @noinspection PhpIncludeInspection */
        include_once($compiled);
    }
};

