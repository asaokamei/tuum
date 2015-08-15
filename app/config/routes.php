<?php
/**
 * routes.php
 * 
 * configures routes for the web application. 
 * 
 * receives $stack as RouterStack to start. 
 * must return the $stack to push to the stack.
 * 
 */
use Demo\Site\SampleController;
use Tuum\Pagination\Html\ToHtmlBootstrap;
use Tuum\Router\RouteCollector;
use Tuum\Web\Psr7\Request;
use Tuum\Web\Stack\RouterStack;
use Tuum\Web\Application;
use Tuum\Web\Web;
use Tuum\Pagination\Html\Paginate;
use Tuum\Pagination\Html\PaginateMini;
use Tuum\Pagination\Html\PaginateNext;
use Tuum\Pagination\Inputs;

/** @var Web $web */
/** @var Application $app */
/** @var RouterStack $stack */
/** @var RouteCollector $routes */

/**
 * start routing using RouteCollection object, $routes. 
 */

$stack  = $web->getRouterStack();
$routes = $stack->getRouting();

// main root

$routes->get( '/', function($request) {
    /** @var Request $request */
    return $request->respond()->asView('index');
});

$routes->get('/pages', function(Request $request) {

    $pager = new Tuum\Pagination\Pager(['_limit' => 5]);
    $pager = $pager->withRequest($request);
    $inputs = $pager->call(function(Inputs $inputs) {
        $inputs->setTotal(70);
    });
    $toHtml = ToHtmlBootstrap::forge();
    $page1 = $toHtml->withPaginate(Paginate::forge()->withInputs($inputs));
    $page2 = $toHtml->withPaginate(PaginateMini::forge()->withInputs($inputs));
    $page3 = $toHtml->withPaginate(PaginateNext::forge()->withInputs($inputs));
    return $request->respond()
        ->with('page1', $page1)
        ->with('page2', $page2)
        ->with('page3', $page3)
        ->with('_limit', $inputs->getLimit())
        ->asView('/pages');
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

/**
 * add sample controller route
 */

$routes->any( '/sample{*}', SampleController::class);


/** ---------------------------------------------------
 * finished routing. 
 * 
 * must return the router stack from routes file. 
 * or return null not to push to the middleware stack. 
 */

return $stack;