<?php

use Tuum\View\Renderer;
use Tuum\Web\Application;
use Tuum\Web\Psr7\Request;
use Tuum\Web\Stack\RouterStack;
use Tuum\Web\Web;

/** @var Web $web */
/** @var Application $app */
/** @var RouterStack $stack */
/** @var Renderer $views */

/**
 * configure RouterStack for DemoTask.
 *
 * set root directory for the demo application using {*}
 * (so that the app does not have to know the root directory).
 */
$task_dir   = dirname(dirname(__DIR__)) . '/src/Tasks';
$app->configure(
    $task_dir . '/scripts/getRouterStack', [
        'web'  => $web,
        'stack' => $stack,
        'view_dir' => null,
    ]
);
$stack->setRoot('/demoTasks{*}');
$stack->setBeforeFilter(
    function($request, $next) {
    /** @var Request $request */
    /** @var callable $next */
    return $next? $next($request->withAttribute('current', 'demoTasks')): null;
});

return $stack;