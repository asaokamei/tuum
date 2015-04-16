<?php

/**
 * Create The Web Application, $app.
 */

use Tuum\Web\Psr7\Request;
use Tuum\Web\Web;

require_once(dirname(__DIR__) . '/vendor/autoload.php');

#
# pre-configuration.
#

$debug        = isset($debug) ? $debug: false;
$xhProf_limit = isset($xhProf_limit) ? $xhProf_limit: '1.0';

date_default_timezone_set('Asia/Tokyo');

# xhprof profiling
include __DIR__ . '/utils/boot-xhprof.php';

# read compiled class files.
include __DIR__ . '/utils/boot-compiled.php';

#
# build and configure $app.
#

$app = Web::forge(__DIR__, $debug);
$app
    ->loadConfig()
    ->loadEnvironment($app->vars_dir . '/env')
    ->catchError()
    ->pushSessionStack()
    ->pushCsRfStack()
    ->pushViewStack()
    ->pushUrlMapper(
        __DIR__ . '/documents'
    )
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
