<?php

namespace App\Core;
use App\Core\RouterService;
use App\Core\Interfaces\Service;

class App
{
    private $router;
    private $config;
    public function __construct(Service $config)
    {
        $this->route = new RouterService($config);
    }

    public function run()
    {
        $this->route->resolve();
    }
}