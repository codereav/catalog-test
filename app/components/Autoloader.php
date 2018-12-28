<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 13:06
 */

namespace App\Components;

class Autoloader
{
    public function __construct()
    {
        spl_autoload_extensions('.php');
        spl_autoload_register(array($this, 'loader'));
    }

    public function loader($class): void
    {
        $class = preg_replace("[\\\]", DS, $class);
        include_once BASE_PATH . DS . $class . '.php';
    }
}