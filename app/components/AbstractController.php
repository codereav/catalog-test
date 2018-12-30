<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 16:59
 */

namespace App\Components;

use App\Components\View;

abstract class AbstractController
{
    protected $view;
    protected $data = [];

    public function __construct()
    {
        $this->view = new View();
        $this->data['baseUrl'] = $this->view->getBaseUrl();
        $this->data['title'] = '';
    }
}