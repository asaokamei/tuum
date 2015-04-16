<?php
/**
 * set up for local environment.
 */
use League\Container\Container;
use Monolog\Logger;
use Tuum\Web\Web;

/** @var Web $app */

$logger = $app->getLog();
$logger->info('local configuration.');

