<?php

use League\Container\Container;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tuum\View\ErrorView;
use Tuum\Web\Web;
use Tuum\Web\Psr7\Respond;

/** @var Container $dic */

/**
 * shared Logger
 *
 * use the de fact MonoLog.
 */
$app->set(
    Web::LOGGER, 
    function () use ($dic) {
    
        $var_dir = $dic->get(Web::VAR_DATA_DIR) . '/log/app.log';
        $logger  = new Logger('log');
        $logger->pushHandler(new StreamHandler($var_dir, Logger::DEBUG));
        return $logger;
}, true);

/**
 * rendering error page. should overwrite this service.
 */
$app->set('service/error-renderer', function () use ($dic) {

    $view = new ErrorView($dic->get(Web::RENDER_ENGINE), $dic->get(Web::DEBUG));
    $view->setLogger($dic->get(Web::LOGGER));

    // error template files for each error status code.
    $view->error_files[Respond::ACCESS_DENIED] = 'errors/forbidden';
    $view->error_files[Respond::FILE_NOT_FOUND] = 'errors/not-found';

    return $view;
});

