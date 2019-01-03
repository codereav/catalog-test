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
    protected $request;
    protected $data = [];
    protected $token;

    public function __construct()
    {
        $this->view = new View();
        $this->request = new Request();
        if ($this->request->session('csrf_token')) {
            $this->token = $this->request->session('csrf_token');
        }
        $this->data['baseUrl'] = $this->view->getBaseUrl();
        $this->data['title'] = '';
        $this->data['token'] = $this->token;

    }
}