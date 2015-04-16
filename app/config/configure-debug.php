<?php

use League\Container\Container;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;
use Tuum\Web\Web;

/** @var Web $app */

/**
 * set up logger for browser's console
 */

/** @var Logger $logger */
$logger = $app->getLog();

if($logger) {
    $logger->pushHandler(
        new BrowserConsoleHandler(Logger::DEBUG)
    );
    $logger->info('debug mode.');
}

