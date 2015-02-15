<?php

/**
 * script to gather used classes for TuumPHP
 */

use Aura\Session\SessionFactory;
use ClassPreloader\ClassLoader;
use Tuum\Web\Psr7\RequestFactory;

$vendor_dir = dirname(dirname(__DIR__)).'/vendor';
require_once( $vendor_dir.'/autoload.php');

$config = ClassLoader::getIncludes(function( ClassLoader $loader) {

    $loader->register();
    $config = include(dirname(__DIR__).'/config.php');

    $boot = include(__DIR__ . '/boot.php');
    
    /** @var Closure $boot */
    $app  = $boot($config);
    $request  = RequestFactory::fromPath('no-such');
    $response = $request->respond()->asForbidden();
    
    $session_factory = new SessionFactory;
    $session         = $session_factory->newInstance($_COOKIE);
    $segment = $session->getSegment('TuumPHP/WebApplication');
    $token = $session->getCsrfToken('sample-token');
    $flash   = $segment->getFlash('flashed');

    $view     = include_once(dirname(dirname(__DIR__)).'/vendor/tuum/web/scripts/compiled/view.php');
    $control  = include_once(dirname(dirname(__DIR__)).'/vendor/tuum/web/scripts/compiled/controller.php');
    $control->__invoke($request);
    return $config;

});

return $config;