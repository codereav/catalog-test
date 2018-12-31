<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 29.12.2018
 * Time: 16:47
 */

namespace App\Components;

use App\Contracts\ModelInterface;

abstract class AbstractRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = Application::getInstance()->getDb()->getInstance();
    }
}