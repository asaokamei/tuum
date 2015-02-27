<?php
use League\Container\Container;
use Monolog\Logger;
use Tuum\Web\App;

/** @var Container $dic */

/** @var Logger $logger */
$logger = $dic->get(App::LOGGER);
$logger->info('local configuration.');

/**
 * set up for local environment.
 */