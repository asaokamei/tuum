<?php

/**
 * Create The Web Application, $app.
 */

use Tuum\Web\Psr7\Request;
use Tuum\Web\Web;

date_default_timezone_set('Asia/Tokyo');

require_once(dirname(__DIR__) . '/vendor/autoload.php');

#
# pre-configuration.
#

$debug        = isset($debug) ? $debug: false;

# read compiled class files.
call_user_func(
    include __DIR__ . '/utils/boot-compiled.php', $debug
);

# xhprof profiling
$xhProf_limit = isset($xhProf_limit) ? $xhProf_limit: '1.0';
call_user_func(
    include __DIR__ . '/utils/boot-xhprof.php', $xhProf_limit
);

#
# build and configure $app.
#


$app = Web::forge(__DIR__, $debug);

$docs = new \Tuum\Web\Stack\DocView(new \Tuum\Locator\Locator(__DIR__ . '/documents'));
$docs->enable_raw = true;
$app
    ->loadConfig()
    ->loadEnvironment($app->vars_dir . '/env')
    ->catchError()
    ->pushSessionStack()
    ->pushViewStack()
    ->pushCsRfStack()
    ->push($docs)
    /*
    ->pushUrlMapper(
        __DIR__ . '/documents'
    )*/
    ->pushRoutes([
        $app->config_dir.'/routes',
        $app->config_dir.'/route-tasks'
    ]);

# add a closure for testing purpose only.
$app->prepend(
    function ($request, $next) {
        /** @var Request $request */
        return $next ? $next($request->withAttribute('closure', function () {
            ;
        })) : null;
    });

return $app;
