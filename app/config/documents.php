<?php

/** @var Web $web */

use Tuum\View\Renderer;
use Tuum\Web\Psr7\Request;
use Tuum\Web\View\Value;
use Tuum\Web\Web;

$stack = $web->getDocViewStack($web->app_dir . '/documents');

$stack->enable_raw = true;
$stack->setRoot('docs*');
$stack->setBeforeFilter(function ($request, $next) {
    /**
     * @var Request $request
     * @return Renderer
     */
    $composer = function ($view) use ($request) {
        /** @var Renderer $view */
        $file_name = basename($request->getUri()->getPath());
        $file_name = $file_name === 'license' ? 'index' : $file_name;
        $view->setLayout('layout/docs-layout', ['file_name' => $file_name]);
        return $view;
    };
    /** @var callable $next */
    $next($request->withAttribute(Value::VIEW_COMPOSER, $composer));
});

return $stack;