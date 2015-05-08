<?php

/**
 * Create The Web Application, $app.
 */

use Tuum\Web\Web;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

# read compiled class files.
call_user_func(include __DIR__ . '/utils/boot-compiled.php', $config);

# xhprof profiling
call_user_func(include __DIR__ . '/utils/boot-xhprof.php', $config);

#
# build and configure $app.
#

/**
 * @param array $config
 * @return \Tuum\Web\Application
 */
return function(array $config)
{
    $app =Web::forge($config);
    $app->pushConfig($app->config_dir . '/route-fast');

    return $app->getApp();
};
