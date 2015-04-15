<?php

/**
 * Create The Web Application, $app.
 */

use Tuum\Web\Web;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

#
# build and configure $app.
#

return Web::forge(__DIR__)
    ->pushRoutes([
        __DIR__ . '/routes',
    ]);

