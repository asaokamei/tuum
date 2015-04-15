<?php

/**
 * script to gather used classes for TuumPHP
 */

use Aura\Session\SessionFactory;
use ClassPreloader\ClassLoader;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tuum\Web\Application;
use Tuum\Web\Psr7\RequestFactory;
use Tuum\Web\Web;

$vendor_dir = dirname(dirname(__DIR__)).'/vendor';
require_once( $vendor_dir.'/autoload.php');

$config = ClassLoader::getIncludes(function( ClassLoader $loader) {

    $loader->register();

    /**
     * monolog
     */
    $logger  = new Logger('compiled-includes');
    $logger->pushHandler(
        new FingersCrossedHandler(new StreamHandler(dirname(dirname(__DIR__)).'/log', Logger::DEBUG))
    );
    $logger->pushHandler(
        new BrowserConsoleHandler(Logger::DEBUG)
    );

    /**
     * load $app, request, and response. 
     */
    /** @var Closure $boot */
    /** @var Web $app */
    $app = Web::forge(dirname(__DIR__), true);
    $app->setup()
        ->pushErrorStack([])
        ->pushSessionStack()
        ->pushCsRfStack()
        ->pushViewStack()
        ->pushUrlMapper(
            dirname(__DIR__).'/documents'
        )
        ->pushRoutes([
            dirname(__DIR__).'/routes'
        ])
    ;
    $request  = RequestFactory::fromPath('no-such');
    $request->respond()->asForbidden();
    
    /**
     * try session stuff.
     */
    $session_factory = new SessionFactory;
    $session         = $session_factory->newInstance($_COOKIE);
    $segment = $session->getSegment('TuumPHP/WebApplication');
    $session->getCsrfToken('sample-token');
    $segment->getFlash('flashed');
    /**
     * view
     */
    include_once(dirname(dirname(__DIR__)).'/vendor/tuum/web/scripts/compiled/view.php');
    $control  = include_once(dirname(dirname(__DIR__)).'/vendor/tuum/web/scripts/compiled/controller.php');
    $control->__invoke($request);

});

return $config;