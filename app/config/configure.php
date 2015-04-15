<?php

use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
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

$app->getViewEngine()->setLayout('/layout/layout');