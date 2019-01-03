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
        $query = 'SELECT 1 from `author` a' .
            ' WHERE a.`lastname` = :lastname' .
            ' AND a.`firstname` = :firstname' .
            ' AND a.`middlename` = :middlename';
        $result = $this->db->prepare($query);
        $result->execute([':lastname' => $lastname, ':firstname' => $firstname, ':middlename' => $middlename]);
        if ($result->rowCount()) {
            return true;
        }
        return false;
    }

    public function getByFIO(string $lastname = '', string $firstname = '', string $middlename = ''): ?AuthorModel
    {
        $query = 'SELECT a.`id`, a.`lastname`, a.`firstname`, a.`middlename` from `author` a' .
            ' WHERE a.`lastname` = :lastname' .
            ' AND a.`firstname` = :firstname' .
            ' AND a.`middlename` = :middlename';
        $result = $this->db->prepare($query);
        $result->execute([':lastname' => $lastname, ':firstname' => $firstname, ':middlename' => $middlename]);
        if ($row = $result->fetch()) {
            return $this->buildData($row, new AuthorModel());
        }
        return null;
    }

    public function getAuthorById(int $id): ?AuthorModel
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            'a.`lastname`, ' .
            'a.`firstname`, ' .
            'a.`middlename` ' .
            'FROM `author` a ' .
            'WHERE a.`id`=:id';

        $result = $this->db->prepare($query);
        $result->execute([':id' => $id]);
        if ($row = $result->fetch()) {
            return $this->buildData($row, new AuthorModel());
        }
        return null;
    }

    public function save(AuthorModel $model): bool
    {
        if (!$model->getId()) {
            return $this->add($model);
        } else {

            //Here can call call update method
            return false;
        }
    }

    private function add(AuthorModel $model): bool
    {
        if ($model->validate()) {
            $query = 'INSERT INTO `author`' .
                '(`lastname`, `firstname`, `middlename`)' .
                ' VALUES(:lastname,:firstname,:middlename)';

            $result = $this->db->prepare($query);
            return $result->execute([
                ':lastname' => $model->getLastname(),
                ':firstname' => $model->getFirstname(),
                ':middlename' => $model->getMiddlename()
            ]);
        }
        return false;
    }
}