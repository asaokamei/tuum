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
     * build and configure web application, $app.
     */

    $app = Web::getApp($config);

    /**
     * configure the application.
     */

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
