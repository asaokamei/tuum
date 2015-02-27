<?php
use Tuum\Web\App;
use Tuum\Web\Web;

/**
 * function to boot web application.
 *
 * @param array $config
 * @return Web
 */
return function( array $config ) {

    /**
     * default configuration.
     */

    $app_root       = dirname(__DIR__);
    $project_root   = dirname($app_root);
    $tuum_scripts   = $project_root.'/vendor/tuum/web/scripts';
    $default_config = [
        'routes'          => $app_root . '/routes.php',
        App::CONFIG_DIR   => $app_root . '/config',
        App::TEMPLATE_DIR => $app_root . '/views',
        App::DOCUMENT_DIR => $app_root . '/docs',
        App::VAR_DATA_DIR => $project_root . '/var',
        App::DEBUG        => false,
    ];
    $config += $default_config;

    /**
     * build and configure web application, $app.
     */

    /** @var Web $app */
    // use Tuum's basic web configuration.

    $app = include($tuum_scripts.'/boot.php');
    $app->configure($tuum_scripts.'/configure');

    // set up directories

    $app->set(App::CONFIG_DIR,   $config[App::CONFIG_DIR]);
    $app->set(App::TEMPLATE_DIR, $config[App::TEMPLATE_DIR]);
    $app->set(App::DOCUMENT_DIR, $config[App::DOCUMENT_DIR]);
    $app->set(App::VAR_DATA_DIR, $config[App::VAR_DATA_DIR]);
    $app->set(App::DEBUG,        $config[App::DEBUG]);

    // use the config dir's configure.

    $config_dir = $config[App::CONFIG_DIR];
    $app->configure($config_dir . '/configure');
    
    if($config[App::DEBUG]) {
        $app->configure($config_dir.'/configure-debug');
    }

    /**
     * set up stacks and routes.
     */

    // set up stacks

    $stacks = $app->get('stacks');
    foreach($stacks as $stack) {
        $app->push($app->get($stack));
    }

    // read the routes.
    // the route files are out of the config directory. 

    $route_files = (array) $config['routes'];
    foreach($route_files as $routes ) {
        $app->push($app->execute($routes));
    }

    return $app;
};
