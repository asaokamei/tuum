<?php
use Tuum\Locator\Container;
use Tuum\Locator\Locator;
use Tuum\Web\App;
use Tuum\Web\Web;

/**
 * function to boot web application.
 *
 * @param array $config
 * @return Web
 */
return function( array $config ) {

    // -----------------------------------------------
    // default configuration
    // -----------------------------------------------
    
    $app_root       = dirname(__DIR__);
    $project_root   = dirname($app_root);
    $default_config = [
        
        // default routes file to set up router.
        'routes' => $app_root.'/routes.php',
        
        // default config directory. 
        'config' => $app_root.'/config',
        
        // default view/template directory.
        'views'  => $app_root.'/views',
        
        // default document/resource directory.
        'docs'   => $app_root.'/docs',
        
        // default var (cache, logs, etc.) directory.
        'var'    => $project_root.'/var',
        
        // default debug is off. 
        'debug'  => false,
    ];
    $config += $default_config;

    // -----------------------------------------------
    // build web application, $app
    // -----------------------------------------------

    // to use Flysystem, use the next line. 
    //$locator = new \Tuum\Locator\UnionManager($config['config']);
    $locator = new Locator($project_root.'/vendor/tuum/web/scripts');
    $locator->addRoot($config['config']);
    $app = new Web(new Container($locator));

    // -----------------------------------------------
    // set up directories
    // -----------------------------------------------
    
    $app->set(App::CONFIG_DIR,   $config['config']);
    $app->set(App::TEMPLATE_DIR, $config['views']);
    $app->set(App::DOCUMENT_DIR, $config['docs']);
    $app->set(App::VAR_DATA_DIR, $config['var']);
    $app->set(App::DEBUG,        $config['debug']);

    // -----------------------------------------------
    // set up services and filters
    // -----------------------------------------------
    
    $app->get('filters');

    // -----------------------------------------------
    // set up stacks
    // -----------------------------------------------
    
    $stacks = $app->get('stacks');
    foreach($stacks as $stack) {
        $app->push($app->get($stack));
    }

    // -----------------------------------------------
    // read the routes.
    // the route files are out of the config directory. 
    // -----------------------------------------------
    
    $route_files = (array) $config['routes'];
    foreach($route_files as $routes ) {
        $app->push($app->execute($routes));
    }

    return $app;
};
