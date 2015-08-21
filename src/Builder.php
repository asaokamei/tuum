<?php


class Builder
{
    /**
     * @var string    directory for application configs. 
     */
    public $app_dir;

    /**
     * @var string    directory for variable files, such as caches.
     */
    public $var_dir;

    /**
     * @var bool
     */
    public $debug = false;

    /**
     * @var array
     */
    private $config = [];

    /**
     * @var mixed
     */
    private $app;

    /**
     * @param string $app_dir
     * @param array  $config
     */
    public function __construct($app_dir, array $config = [])
    {
        $this->app_dir = $app_dir;
        $this->var_dir = isset($config['var_dir']) ? $config['var_dir'] : dirname($app_dir).'/vars';
        $this->debug   = isset($config['debug']) ? $config['debug'] : $this->debug;

        // clean up and set config
        unset($config['app_dir']);
        unset($config['var_dir']);
        unset($config['debug']);
        $this->config = $config;
    }

    /**
     * configure by including a PHP file, $config_name, at $this->app_dir. 
     * the configuration file *must* return the application, $app. 
     * 
     * @param string|Closure $config_name
     * @return $this
     */    
    public function configure($config_name)
    {
        if (is_string($config_name)) {
            return $this->configByPhpFile($config_name);
        } elseif (is_callable($config_name)) {
            return $this->configByClosure($config_name);
        }
        throw new RuntimeException;
    }

    /**
     * @param string $configure
     * @return $this
     */
    private function configByPhpFile($configure)
    {
        $configure = '/' . ltrim($configure, '/');
        $configure = $this->app_dir . $configure;
        /** @noinspection PhpUnusedLocalVariableInspection */
        $app = $this->app;
        if (fileExists($configure)) {
            /** @noinspection PhpIncludeInspection */
            $this->app = include $configure;
        }
        return $this;
    }

    /**
     * @param callable $configure
     * @return $this
     */
    private function configByClosure($configure)
    {
        $this->app = $configure($this->app, $this);
        return $this;
    }

    /**
     * @param        $env_file
     * @param string $config_file
     * @return $this
     */
    public function environments($env_file, $config_file = 'configure')
    {
        $env_file = '/' . trim($env_file, '/');
        $config_file = '/' . trim($config_file, '/');
        /** @noinspection PhpIncludeInspection */
        $environments = (array) include($this->var_dir . $env_file);
        if ($this->debug) {
            $environments[] = 'debug';
        }
        foreach($environments as $env) {
            $this->configure($this->var_dir . $env . $config_file);
        }
        return $this;
    }
    
    /**
     * caches entire Application, $app, to a file.
     * specify $closure to construct the application in case cache file is absent.
     *
     * @param string          $name
     * @param Closure|string  $configure
     * @return $this
     */
    public function cacheApp($name, $configure)
    {
        $cached = $this->var_dir . "/app-{$name}.cached";
        if (!$this->debug && file_exists($cached)) {
            $this->app = unserialize(\file_get_contents($cached));
            return $this;
        }
        $this->configure($configure);
        if ($this->debug) {
            return $this;
        }
        if (false === \file_put_contents($cached, serialize($this->app))) {
            throw new RuntimeException;
        }
        chmod($cached, 0666);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

}