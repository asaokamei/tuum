<?php

/**
 * This is TuumPHP 
 */

use Tuum\Web\Psr7\RequestFactory;
use Tuum\Web\Web;

#
# create a web application.
#

$debug        = true;
$xhProf_limit = '1.0';

/** @var Web $app */
$app = include( dirname(__DIR__).'/app/app.php' );

#
# run the $app. 
#

$request  = RequestFactory::fromGlobals();
$response = $app->__invoke($request);
$response->send();
