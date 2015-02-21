<?php

use Demo\Tasks\TaskStack;
use League\Container\Container;
use Tuum\Web\Stack\Dispatcher;
use Tuum\Web\Web;

/** @var Web $app */
/** @var Container $dic */

if(isset($views) && $views) {
    $app->setRenderRoot($views);
}

$taskStack = new TaskStack(new Dispatcher($app), 'Demo\Tasks\TaskController');
if(isset($root)) {
    $taskStack->setRoot($root);
}
return $taskStack;