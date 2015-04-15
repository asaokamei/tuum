<?php
use Tuum\Web\Psr7\Request;
use Tuum\Web\Psr7\RequestFactory;
use Tuum\Web\Application;
use Tuum\Web\Psr7\Respond;
use Tuum\Web\Web;

require_once( dirname( __DIR__ ) . '/vendor/autoload.php' );

/** @var Web $app */

$debug = false;

date_default_timezone_set('Asia/Tokyo');

/*
 * pre-configuration of building $app.
 */

// xhprof profiling
include __DIR__.'/utils/xhprof.php';

// read compiled class files.
include __DIR__ . '/utils/boot-compiled.php';

/**
 * build and configure $app.
 */
$app = Web::forge(__DIR__, $debug);
$app
    ->pushErrorStack([
        Respond::ACCESS_DENIED  => 'errors/forbidden',
        Respond::FILE_NOT_FOUND => 'errors/not-found',
    ])
    ->pushSessionStack()
    ->pushCsRfStack()
    ->pushViewStack()
    ->pushUrlMapper(
        __DIR__.'/documents'
    )
    ->pushRoutes([
        __DIR__.'/routes.php',
        __DIR__.'/route-tasks.php'
    ])
;

$app->prepend(
    function($request, $next) {
    /** @var Request $request */
    return $next?$next($request->withAttribute('closure', function(){;})) : null;
});
/*
 * run $app
 */
$request  = RequestFactory::fromGlobals();
$response = $app->__invoke( $request );
$response->send();
