<?php

use Demo\Tasks\TaskController;
use Demo\Tasks\TaskDao;
use League\Container\Container;
use Tuum\Router\RouteCollector;
use Tuum\View\Renderer;
use Tuum\Web\Application;
use Tuum\Web\Stack\RouterStack;
use Tuum\Web\Web;

/** @var Web $web */
/** @var Application $app */
/** @var RouterStack $stack */
/** @var RouteCollector $routes */
/** @var Container $dic */

/**
 * set up TaskDao factory.
 */
$app->set( TaskDao::class, function() use($web) {
    return new TaskDao($web->vars_dir.'/data/tasks.csv');
});


/**
 * configure the route.
 *
 * make sure the main application will specify the root
 * using {*} so that task application does not have to
 * know its root directory.
 */
$routes     = $stack->getRouting();

$routes->any('/*', TaskController::class);


/**
 * configure the views.
 *
 * use the view files as specified by the parent.
 * specify another directory if there are another
 * view directory prepared for the demo.
 */
/** @var Renderer $views */
$views = $app->get(Web::RENDER_ENGINE);

if (isset($view_dir) && $view_dir) {
    $views->locator->addRoot($view_dir);
} else {
    $views->locator->addRoot(dirname(__DIR__) . '/views');
}

return $stack;