<?php

use Tuum\Web\Application;

/** @var Application $app */

$task_dir = dirname(__DIR__).'/src/Tasks';

$app->setConfigRoot($task_dir.'/scripts');

return $app->configure('tasks/setup', [
    'root' => 'demoTasks{*}', // tasks url root name.
    'views' => $task_dir.'/views',  // set view dir for task, or set to null to use current views.
]);
    