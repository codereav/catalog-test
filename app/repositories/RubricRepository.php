<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 30.12.2018
 * Time: 11:01
 */

namespace App\Repositories;

use App\Components\AbstractRepository;

class RubricRepository extends AbstractRepository
{
    public function findRubrics(): void
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title` ' .
            'FROM `rubric` a ';

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            $this->data = $rows;
        }
    }
}