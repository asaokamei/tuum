<?php

/**
 * enable xh-profiler
 */
if (!function_exists('xhprof_enable')) {
    return;
}
if (!isset($slow_limit)) {
    $slow_limit = '1.0'; // default threshold in second.
}

/*
 * starting xh-profiler
 */
call_user_func(function () use($slow_limit) {

    xhprof_enable();
    $start_time = microtime(true);
    $app_name   = 'TuumPHP';
    $prof_root  = '/usr/local/Cellar/php56-xhprof/254eb24';

    /*
     * register xh-prof at shutdown.
     */
    register_shutdown_function(function () use ($app_name, $prof_root, $start_time, $slow_limit) {

        $xhprof_data = xhprof_disable();
        $end_time    = microtime(true);
        if ($end_time - $start_time < $slow_limit) {
            return;
        }

        include_once $prof_root . '/xhprof_lib/utils/xhprof_lib.php';
        include_once $prof_root . '/xhprof_lib/utils/xhprof_runs.php';

        $xhprof_runs = new XHProfRuns_Default();
        $xhprof_runs->save_run($xhprof_data, $app_name);

    });

});
