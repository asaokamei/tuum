<?php

/**
 * This is Tuum
 */

use Tuum\Web\Application;
use Tuum\Web\Psr7\RequestFactory;

#
# create a web application.
#

$app_dir = dirname(__DIR__) . '/app';
$config = [
    'debug'   => true,
    'xhProf'  => false,
    'app_dir' => $app_dir,
];

/** @var Application $app */
$config = call_user_func(include($app_dir.'/config.php'), $config);
$app    = call_user_func(include($app_dir.'/app.php'), $config);

#
# use the following for cheating speed contest.
# 
# $app    = call_user_func(include($app_dir.'/app-fast.php'), $config);
#

#
# run the $app. 
#

$request  = RequestFactory::fromGlobalData($GLOBALS)->withApp($app);
$response = $app->__invoke($request);
$response->send();
