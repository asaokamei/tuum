<?php
use Tuum\Web\Web;
use Tuum\Web\Application;

/**
 * function to boot web application.
 *
 * @param array $config
 * @return Application
 */
return function( array $config ) {

    /**
     * default configuration.
     */

    $tuum_scripts   = dirname(dirname(__DIR__)).'/vendor/tuum/web/scripts';

    /**
     * build and configure web application, $app.
     */

    /** @var Application $app */
    $app = include($tuum_scripts.'/boot.php');

    // use Tuum's basic web configuration.
    
    $app->configure($tuum_scripts.'/configure');

    // set up directories
    
    $app->set(Web::CONFIG_DIR,   $config[Web::CONFIG_DIR]);
    $app->set(Web::TEMPLATE_DIR, $config[Web::TEMPLATE_DIR]);
    $app->set(Web::DOCUMENT_DIR, $config[Web::DOCUMENT_DIR]);
    $app->set(Web::VAR_DATA_DIR, $config[Web::VAR_DATA_DIR]);
    $app->set(Web::DEBUG,        $config[Web::DEBUG]);

    // use the config directory's configure.
    
    $config_dir = $config[Web::CONFIG_DIR];
    $app->configure($config_dir . '/configure');
    
    // debug configuration
    
    if($config[Web::DEBUG]) {
        $app->configure($config_dir.'/configure-debug');
    }
    
    // environment specific configuration
    
    /** @noinspection PhpIncludeInspection */
    if( $environment = (array) include($config['environment'])) {
        foreach($environment as $env) {
            $app->configure($config_dir."/{$env}/configure");
        }
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
        $app->push($app->configure($routes));
    }

    return $app;
};
