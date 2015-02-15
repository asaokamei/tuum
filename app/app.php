<?php
use Tuum\Web\Psr7\RequestFactory;
use Tuum\Web\Web;

require_once( dirname( __DIR__ ) . '/vendor/autoload.php' );

/** @var \Closure $boot */
/** @var Web $app */

date_default_timezone_set('Asia/Tokyo');

// xhprof profiling
include __DIR__.'/utils/xhprof.php';

/*
 * get configuration
 */
$config = include __DIR__.'/config.php';

/*
 * boot $app
 */
$boot = include __DIR__ . '/utils/boot.php';
$boot = include __DIR__ . '/utils/boot-prep.php';
$app  = $boot($config);

/*
 * run $app
 */
$request  = RequestFactory::fromGlobals();
$response = $app->__invoke( $request );
$response->send();
