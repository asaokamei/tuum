<?php

use Tuum\Web\App;
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
    $compiled = $config[App::VAR_DATA_DIR].'/compiled.php';
    if(!$config[App::DEBUG] && file_exists($compiled)) {
        include_once($compiled);
    }

    /*
     * build $boot.
     */
    return $boot($config);
};