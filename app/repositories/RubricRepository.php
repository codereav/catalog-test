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
        $model->setParentId($data['parent_id'] ?? $model->getParentId());
        $model->setChildren($data['children'] ?? $model->getChildren());

        return $model;
    }

    public function getRubrics(): array
    {
        $res = [];
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title`, ' .
            ' a. `parent_id` ' .
            'FROM `rubric` a ' .
            ' ORDER BY a.`parent_id`';

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            foreach ($rows as $rawData) {
                $res[] = $this->buildData($rawData, new RubricModel());
            }
        }
        return $res;
    }

    public function buildTreeArray(array $rubrics, ?int $parent_id = null): array
    {
        $result = [];
        foreach ($rubrics as $key => $rubric) {
            if ($rubric->getParentId() === $parent_id) {
                unset($rubrics[$key]);
                $children = $this->buildTreeArray($rubrics, $rubric->getId());

                if (isset($children)) {
                    $rubric->setChildren($children);
                }
                $result[$rubric->getId()] = $rubric;
            }
        }
        return $result;
    }

    public function getTreeHtml(array $rubrics): string
    {
        $str = '';
        foreach ($rubrics as $key => $rubric) {
            unset($rubrics[$key]);
            $str .= '<li>';
            $str .= '<a href="" data-rubric_id="' . $rubric->getId() . '">' . $rubric->getTitle() . '</a>';
            if ($children = $rubric->getChildren()) {
                $str .= '<ul>';
                $str .= $this->getTreeHtml($children, $str);
                $str .= '</ul>';
            }
            $str .= '</li>';
        }
        return $str;
    }

    public function getRubricById(int $id): ?RubricModel
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title` ' .
            'FROM `rubric` a ' .
            'WHERE a.`id`=:id';

        $result = $this->db->prepare($query);
        $result->execute([':id' => $id]);
        if ($row = $result->fetch()) {
            return $this->buildData($row, new RubricModel());
        }
        return null;
    }

    public function hasChildRubric(int $rubricId): bool
    {
        $query = 'SELECT 1 FROM `rubric` ' .
            'WHERE `parent_id`=:parent_id LIMIT 1';
        $result = $this->db->prepare($query);
        $result->execute([':parent_id' => $rubricId]);
        if ($result->rowCount()) {
            return true;
        }
        return false;
    }

    public function getChildRubrics(int $parentId): array
    {
        $res = [];
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title` ' .
            'FROM `rubric` a ' .
            'WHERE a.`parent_id`=:parent_id';
        $result = $this->db->prepare($query);
        $result->execute([':parent_id' => $parentId]);
        if ($rows = $result->fetchAll()) {
            foreach ($rows as $rawData) {
                $res[] = $this->buildData($rawData, new RubricModel());
            }
        }
        return $res;
    }

    public function isRubricExists(int $id): ?RubricModel
    {
        $query = 'SELECT 1 FROM `rubric` a WHERE a.`id`=:id';
        $result = $this->db->prepare($query);
        $result->execute([':id' => $id]);
        if ($row = $result->fetch()) {
            return $this->buildData($row, new RubricModel());
        }
        return null;
    }
}