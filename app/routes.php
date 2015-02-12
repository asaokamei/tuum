<?php

use Demo\Site\SampleController;
use Tuum\Router\Tuum\Router;
use Tuum\Routing\RouteCollector;
use Tuum\Web\Psr7\Request;
use Tuum\Web\Stack\Dispatcher;
use Tuum\Web\Stack\RouterStack;
use Tuum\Web\Web;

/** @var Web $app */

// --------------------
// create basic routers
// --------------------

$router = Router::forge();
$routes = $router->getRouting();

// ----------
// add routes
// ----------

$routes->get( '/', function($request) {
    /** @var Request $request */
    return $request->respond()->asView('index');
});


/**
 * routes for closure/ pattern.
 * all are from closure.
 */
$routes->group(
    [
        'pattern' => '/closure',
    ],
    function($routes) {
        /** @var RouteCollector $routes */

        $routes->get( '', function($request) {
            /** @var Request $request */
            return $request->respond()->asHtml('<html><body><h1>This is from a closure!</h1></body></html>');
        });

        $routes->get( '/view', function($request) {
            /** @var Request $request */
            return $request->respond()->asView('closure-view');
        });

        $routes->get( '/text', function() {
            return 'a text from closure';
        });

        $routes->get( '/array', function() {
            return ['arrays' => 'json'];
        });

    });

/*
 * add sample controller
 */
$routes->any( '/sample{*}', SampleController::class);

/* -------------------
 * create router stack 
 */

$routeStack = new RouterStack($router, new Dispatcher($app));
$routeStack->setRoot('/');
$routeStack->setRoot('/closure*');
$routeStack->setRoot('/sample*');

return $routeStack;