<?php

use League\Container\Container;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tuum\Form\Dates;
use Tuum\Form\Forms;
use Tuum\Locator\Locator;
use Tuum\View\ErrorView;
use Tuum\View\Renderer;
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
    function () use ($app) {
    
        $var_dir = $app->vars_dir . '/log/app.log';
        $logger  = new Logger('log');
        $logger->pushHandler(
            new FingersCrossedHandler(new StreamHandler($var_dir, Logger::DEBUG))
        );
        return $logger;
}, true);

$app->getViewEngine()->setLayout('/layout/layout');