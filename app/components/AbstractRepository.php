<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 29.12.2018
 * Time: 16:47
 */

namespace App\Components;

abstract class AbstractRepository
{
    protected $db;
    protected $data = [];

    public function __construct()
    {
        $this->db = Application::getInstance()->getDb()->getInstance();
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function getOne(): array
    {
        return reset($this->data);
    }

}