<?php

use Tuum\Web\Application;

/** @var Application $app */

$task_dir = dirname(__DIR__).'/src/Tasks';

return $app->configure(
    $task_dir.'/scripts/tasks/setup', 
    [
        'root' => 'demoTasks{*}', // tasks url root name.
        'views' => $task_dir.'/views',  // set view dir for task, or set to null to use current views.
]);
    