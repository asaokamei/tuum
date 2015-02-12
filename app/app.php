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
    'var'    => dirname(__DIR__).'/var',
    'routes' => [
        __DIR__.'/routes.php',
        __DIR__.'/route-tasks.php',
    ],
];

if($config['debug'] && file_exists($config['var'].'/compiled.php')) {
    include_once($config['var'].'/compiled.php'     );
}
$boot = include( __DIR__.'/boot.php' );
$app  = $boot($config);

$request  = RequestFactory::fromGlobals();
$response = $app->__invoke( $request );
$response->send();
