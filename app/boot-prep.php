<?php

use Tuum\Web\Web;

/**
 * function to pre-process before booting a web application.
 * $boot must exist.
 *
 * @param array $config
 * @return Web
 */

return function( array $config ) use($boot) {

    /*
     * read compiled php file,
     * if debug is false, and compiled.php exists.
     */
    $compiled = $config['var'].'/compiled.php';
    if(!$config['debug'] && file_exists($compiled)) {
        include_once($compiled);
    }

    /*
     * build $boot.
     */
    return $boot($config);
};