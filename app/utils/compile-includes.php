<?php

/**
 * script to gather used classes for TuumPHP
 */

use ClassPreloader\ClassLoader;
use Tuum\Web\Psr7\RequestFactory;

$vendor_dir = dirname(dirname(__DIR__)).'/vendor';
require_once( $vendor_dir.'/autoload.php');

$config = ClassLoader::getIncludes(function( ClassLoader $loader) {

    $loader->register();
    $config = include(dirname(__DIR__).'/config.php');

    $boot = include(dirname(__DIR__) . '/boot.php');
    /** @var Closure $boot */
    $app  = $boot($config);
    $request  = RequestFactory::fromPath('compile');
    $response = $request->respond()->asForbidden();

});

return $config;