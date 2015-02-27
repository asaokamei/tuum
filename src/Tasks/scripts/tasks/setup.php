<?php

use Demo\Tasks\TaskStack;
use League\Container\Container;
use Tuum\Web\Stack\Dispatcher;
use Tuum\Web\Application;
use Tuum\Web\Web;

/** @var Application $app */
/** @var Container $dic */

if(isset($views) && $views) {
    $engine = $app->get(Web::RENDER_ENGINE);
    $engine->locator->addRoot($views);
}

$taskStack = new TaskStack(new Dispatcher($app), 'Demo\Tasks\TaskController');
if(isset($root)) {
    $taskStack->setRoot($root);
}
return $taskStack;