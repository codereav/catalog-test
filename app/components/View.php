<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 28.12.2018
 * Time: 17:30
 */

namespace App\Components;

class View
{
    private $folder;

    public function __construct($folder = null)
    {
        if ($folder !== null) {
            $this->folder = $folder;
        }
    }

    public function render($template)
    {
        //TODO: implement render method
    }

}