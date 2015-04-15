<?php

/**
 * Create The Web Application, $app.
 */

use Tuum\Web\Web;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

#
# build and configure $app.
#

$app =Web::forge(__DIR__);
$app->pushRoutes([
        $app->config_dir . '/route-fast',
    ]);

return $app;
