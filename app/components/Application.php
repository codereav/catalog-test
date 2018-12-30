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
    private static $instance;
    protected $db;

    public function __construct(array $config = [], Router $router = null, Database $db = null)
    {
        if (self::$instance === null) {
            $this->config = $config;
            $this->router = $router;
            $this->db = $db;

            self::$instance = $this;
        }
    }

    public function run(): void
    {
        $this->router->addRoutes($this->config['routes']);
        $this->router->dispatch();
    }

    public static function getInstance(): Application
    {
        return self::$instance;
    }

    public function getDb(): Database
    {
        return $this->db;
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}