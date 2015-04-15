<?php

/**
 * function to pre-process before booting a web application.
 * $boot must exist.
 *
 */

if(!isset($debug) || !$debug) {
    return;
}
if(!isset($var_dir)) {
    $var_dir = dirname(dirname(__DIR__)).'/var';
}

call_user_func( function() use($debug, $var_dir) {

    $compiled = $var_dir.'/compiled.php';
    if(!$debug && file_exists($compiled)) {
        include_once($compiled);
    }
});
/*
 * read compiled php file,
 * if debug is false, and compiled.php exists.
 */
