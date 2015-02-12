<?php

/**
 * enable xh-profiler
 */
if(!function_exists('xhprof_enable')) return;

/*
 * starting xh-profiler
 */
xhprof_enable();

$app_name = 'TuumPHP';
$prof_root   = '/usr/local/Cellar/php56-xhprof/254eb24';

/*
 * register xh-prof at shutdown.
 */
register_shutdown_function(function() use($app_name, $prof_root) {

    $xhprof_data = xhprof_disable();

    include_once $prof_root . '/xhprof_lib/utils/xhprof_lib.php';
    include_once $prof_root . '/xhprof_lib/utils/xhprof_runs.php';
    
    $xhprof_runs = new XHProfRuns_Default();
    $run_id = $xhprof_runs->save_run($xhprof_data, $app_name);
    
    echo "<a href='http://localhost:8800/xhprof_html/index.php?run=$run_id&source=$app_name' target='_blank'>xhprof Result</a>";

});
