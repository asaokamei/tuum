<?php
/**
 * configuration for application.
 */
use Tuum\Web\Application;
use Tuum\Web\Psr7\Respond;
use Tuum\Web\Web;

/** @var Application $web */
/** @var Web $web */

/**
 * set up default layout file for templates.
 */
$web->getViewEngine()->setLayout('/layout/layout');

/**
 * set up template files for error by error number.
 */
$app->set( Web::ERROR_VIEWS,
    [
        'errors/error', // default error view
        Respond::ACCESS_DENIED  => 'errors/forbidden',
        Respond::FILE_NOT_FOUND => 'errors/not-found',
    ]);