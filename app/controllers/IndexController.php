<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 16:57
 */

namespace App\Controllers;

use App\Components\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        echo 'MAIN PAGE';
    }

    public function articleViewAction(int $id)
    {
        echo 'SHOW ARTICLE ' . $id;
    }
}