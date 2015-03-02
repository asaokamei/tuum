<?php

use League\Container\Container;
use Monolog\Handler\FingersCrossedHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Tuum\Form\Dates;
use Tuum\Form\Forms;
use Tuum\Locator\Locator;
use Tuum\View\ErrorView;
use Tuum\View\Tuum\Renderer;
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
        $logger->pushHandler(
            new FingersCrossedHandler(new StreamHandler($var_dir, Logger::DEBUG))
        );
        return $logger;
}, true);

/**
 * Rendering Engine (Template)
 *
 * default is Tuum's view engine.
 * use it as a singleton.
 */
$app->set(Web::RENDER_ENGINE, function() use($dic) {

    $view = new Renderer(
        new Locator($dic->get(Web::TEMPLATE_DIR))
    );
    $view->register('forms', new Forms());
    $view->register('dates', new Dates());
    $view->withView('layout/layout');
    return $view;
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

