<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 13:20
 */

namespace App\Components;

class Application
{
    private $config;
    private $router;

    public function __construct(array $config, Router $router)
    {
        $this->config = $config;
        $this->router = $router;
    }

    public function run(): void
    {
        $this->router->addRoutes($this->config['routes']);
        $this->router->dispatch();
    }
}