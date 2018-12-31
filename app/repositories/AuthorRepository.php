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
    private function buildData(array $data, AuthorModel $model): AuthorModel
    {
        $model->setId($data['id'] ?? $model->getId());
        $model->setLastname($data['lastname'] ?? $model->getLastname());
        $model->setFirstname($data['firstname'] ?? $model->getFirstname());
        $model->setMiddlename($data['middlename'] ?? $model->getMiddlename());

        return $model;
    }

    public function isAuthorExists(string $lastname = '', string $firstname = '', string $middlename = ''): bool
    {
        $query = 'SELECT 1 from `author` a ' .
            'WHERE a.`lastname`="' . $lastname . '"' .
            ' AND a.`firstname` = "' . $firstname . '"' .
            ' AND a.`middlename` = "' . $middlename . '"';
        $result = $this->db->query($query);
        if ($result->rowCount()) {
            return true;
        }
        return false;
    }

    public function getAuthorById(int $id): ?AuthorModel
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            'a.`lastname`, ' .
            'a.`firstname`, ' .
            'a.`middlename` ' .
            'FROM `author` a ' .
            'WHERE a.`id`=' . $id;

        $result = $this->db->query($query);
        if ($row = $result->fetch()) {
            return $this->buildData($row, new AuthorModel());
        }
        return null;
    }
}