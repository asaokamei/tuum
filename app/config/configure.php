<?php
/**
 * configuration for application.
 */
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tuum\Web\Psr7\Respond;
use Tuum\Web\Web;

/** @var Web $app */

/**
 * shared Logger
 *
 * use the de fact MonoLog.
 */
$app->set(
    Web::LOGGER, 
    function () use ($app) {
    
        $var_dir = $app->vars_dir . '/log/app.log';
        $logger  = new Logger('log');
        $logger->pushHandler(
            new FingersCrossedHandler(new StreamHandler($var_dir, Logger::DEBUG))
        );
        return $logger;
}, true);

/**
 * set up default layout file for templates.
 */
$app->getViewEngine()->setLayout('/layout/layout');

/**
 * set up template files for error by error number.
 */
$app->set( Web::ERROR_VIEWS, [
    Respond::ACCESS_DENIED  => 'errors/forbidden',
    Respond::FILE_NOT_FOUND => 'errors/not-found',
]);