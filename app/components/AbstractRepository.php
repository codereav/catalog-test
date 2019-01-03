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
    protected $lastInsertId;

    public function __construct()
    {
        $this->db = Application::getInstance()->getDb()->getInstance();
    }

    public function getLastInsertId(bool $fromVar = false): int
    {
        if ($fromVar) {
            return $this->lastInsertId ?? $this->db->lastInsertId();
        }
        return $this->db->lastInsertId();
    }
}