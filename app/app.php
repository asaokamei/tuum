<?php
use Tuum\Web\Psr7\RequestFactory;
use Tuum\Web\Web;

require_once( dirname( __DIR__ ) . '/vendor/autoload.php' );

/** @var \Closure $boot */
/** @var Web $app */

date_default_timezone_set('Asia/Tokyo');

// xhprof 
// include __DIR__.'/xhprof.php';

$config = [
    'debug'  => true,
    'routes' => [
        __DIR__.'/routes.php',
        __DIR__.'/route-tasks.php',
    ],
];
$boot = include( __DIR__.'/boot.php' );
$app  = $boot($config);

$request  = RequestFactory::fromGlobals();
$response = $app->__invoke( $request );
$response->send();
