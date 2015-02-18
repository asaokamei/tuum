<?php

use League\Container\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tuum\View\ErrorView;
use Tuum\Web\App;
use Tuum\Web\Psr7\Respond;

/** @var Container $dic */

/**
 * Logger
 *
 * use the de fact MonoLog.
 */
$app->set(App::LOGGER, function () use ($dic) {

    $var_dir = $dic->get(App::VAR_DATA_DIR) . '/log/app.log';
    $logger  = new Logger('log');
    $logger->pushHandler(new StreamHandler($var_dir, Logger::DEBUG));
    return $logger;
});

/**
 * rendering error page. should overwrite this service.
 */
$dic->add('service/error-renderer', function () use ($dic) {

    $view = new ErrorView($dic->get(App::RENDER_ENGINE), $dic->get(App::DEBUG));
    $view->setLogger($dic->get(App::LOGGER));

    // error template files for each error status code.
    $view->error_files[Respond::ACCESS_DENIED] = 'errors/forbidden';
    $view->error_files[Respond::FILE_NOT_FOUND] = 'errors/not-found';

    return $view;
});

/**
 * stack list.
 *
 * return list of stacks to push.
 *
 */
$dic->add('stacks', function () {
    return [
        /*
         * basic stack
         */
        'stack/error-stack',
        'stack/session-stack',
        'stack/cs-rf-stack',
        'stack/view-stack',

        /*
         * handlers and releases
         */
        'stack/url-mapper-handler',
    ];
});