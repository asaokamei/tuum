<?php

/**
 * This is Tuum
 */

use Tuum\Web\Psr7\RequestFactory;
use Tuum\Web\Web;

#
# create a web application.
#

$debug        = true;
$xhProf_limit = false;

/** @var Web $app */
$app = include( dirname(__DIR__).'/app/app.php' );

//
// use the following for cheating speed contest.
// 
// $app = include( dirname(__DIR__).'/app/app-fast.php' );
// $request  = RequestFactory::fromGlobalData($GLOBALS)->withApp($app);
//

#
# run the $app. 
#

$request  = RequestFactory::fromGlobalData($GLOBALS)->withApp($app);
$response = $app->__invoke($request);
$response->send();
echo memory_get_usage();