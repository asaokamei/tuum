<?php

/**
 * Create The Web Application, $app.
 */

use Tuum\Web\Web;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

$debug        = isset($debug) ? $debug: false;

# read compiled class files.
call_user_func(
    include __DIR__ . '/utils/boot-compiled.php', $debug
);

# xhprof profiling
$xhProf_limit = isset($xhProf_limit) ? $xhProf_limit: '1.0';
call_user_func(
    include __DIR__ . '/utils/boot-xhprof.php', $xhProf_limit
);

#
# build and configure $app.
#

$app =Web::forge(__DIR__);
$app->pushConfig($app->config_dir . '/route-fast');

return $app->getApp();
