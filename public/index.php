<?php

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
defined('BASE_PATH') or define('BASE_PATH', __DIR__ . DS . '..');
defined('APP_PATH') or define('APP_PATH', __DIR__ . DS . '..' . DS . 'app');

require APP_PATH . DS . 'autoload.php';
$config = require APP_PATH . DS . 'config.php';

$app = new \App\Components\Application($config, new \App\Components\Router(), new \App\Components\Database($config['mysql']));

$app->run();
