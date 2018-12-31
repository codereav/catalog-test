<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 30.12.2018
 * Time: 11:01
 */

namespace App\Repositories;

use App\Components\AbstractRepository;
use App\Models\RubricModel;

class RubricRepository extends AbstractRepository
{
    private function buildData(array $data, RubricModel $model): RubricModel
    {
        $model->setId($data['id'] ?? $model->getId());
        $model->setTitle($data['title'] ?? $model->getTitle());

        return $model;
    }

    public function getRubrics(): array
    {
        $res = [];
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title` ' .
            'FROM `rubric` a ';

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            foreach ($rows as $rawData) {
                $res[] = $this->buildData($rawData, new RubricModel());
            }
        }
        return $res;
    }
}