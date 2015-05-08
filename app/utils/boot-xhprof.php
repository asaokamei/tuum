<?php

/**
 * enable xh-profiler
 */
return function (array $config) {

    if (!function_exists('xhprof_enable')) {
        return;
    }
    $xhProf_limit = $config['xhProf'];
    if ($xhProf_limit === true) {
        $xhProf_limit = 0.0;
    }
    elseif ($xhProf_limit === false || !is_numeric($xhProf_limit)) {
        return;
    }
    xhprof_enable();
    $start_time = microtime(true);
    $app_name   = $config['app_name'];
    $prof_root  = '/usr/local/Cellar/php56-xhprof/254eb24';

    /*
     * register xh-prof at shutdown.
     */
    register_shutdown_function(function () use ($app_name, $prof_root, $start_time, $xhProf_limit) {

        $xhprof_data = xhprof_disable();
        $end_time    = microtime(true);
        if ($end_time - $start_time < $xhProf_limit) {
            return;
        }

        include_once $prof_root . '/xhprof_lib/utils/xhprof_lib.php';
        include_once $prof_root . '/xhprof_lib/utils/xhprof_runs.php';

        /** @noinspection PhpUndefinedClassInspection */
        $xhprof_runs = new XHProfRuns_Default();
        /** @noinspection PhpUndefinedMethodInspection */
        $xhprof_runs->save_run($xhprof_data, $app_name);

    });

};
