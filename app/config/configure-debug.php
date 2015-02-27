<?php

use League\Container\Container;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;
use Tuum\Web\App;

/** @var Container $dic */

/**
 * set up logger for browser's console
 */

/** @var Logger $logger */
$logger = $dic->get(App::LOGGER);
$logger->pushHandler(
    new BrowserConsoleHandler()
);

$logger->info('debug mode.');