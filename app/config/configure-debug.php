<?php

use League\Container\Container;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;
use Tuum\Web\Web;

/** @var Container $dic */

/**
 * set up logger for browser's console
 */

/** @var Logger $logger */
$logger = $dic->get(Web::LOGGER);
$logger->pushHandler(
    new BrowserConsoleHandler()
);

$logger->info('debug mode.');