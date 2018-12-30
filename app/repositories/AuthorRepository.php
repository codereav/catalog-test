<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 30.12.2018
 * Time: 11:08
 */

namespace App\Repositories;

use App\Components\AbstractRepository;
use App\Models\AuthorModel;

class AuthorRepository extends AbstractRepository
{
    private $model;

    public function __construct(AuthorModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function authorExists(): bool
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            'a.`lastname`, ' .
            'a.`firstname`, ' .
            'a.`middlename` ' .
            'FROM `author` a ' .
            'WHERE a.`lastname`="' . $this->model->getLastname() . '"' .
            ' AND a.`firstname` = "' . $this->model->getFirstname() . '"' .
            ' AND a.`middlename` = "' . $this->model->getMiddlename() . '"';

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            $this->data = $rows;
            return true;
        }
        return false;
    }

    public function findById(): void
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            'a.`lastname`, ' .
            'a.`firstname`, ' .
            'a.`middlename` ' .
            'FROM `author` a ' .
            'WHERE a.`id`=' . $this->model->getId();

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            $this->data = $rows;
        }
    }
}