<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 29.12.2018
 * Time: 16:54
 */

namespace App\Repositories;

use App\Components\AbstractRepository;
use App\Models\ArticleModel;

class ArticleRepository extends AbstractRepository
{

    private function buildData(array $data, ArticleModel $model): ArticleModel
    {
        $model->setId($data['id'] ?? $model->getId());
        $model->setTitle($data['title'] ?? $model->getTitle());
        $model->setAuthorId($data['author_id'] ?? $model->getAuthorId());
        $model->setAuthorName($data['author_name'] ?? $model->getAuthorName());
        $model->setContent($data['content'] ?? $model->getContent());

        return $model;
    }

    public function getArticles(): array
    {
        $res = [];
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title`, ' .
            ' a.`content`, ' .
            ' a.`author_id`, ' .
            ' CONCAT(b.`lastname`, \' \', b.`firstname`, \' \', b.`middlename`) as author_name ' .
            'FROM `article` a ' .
            'LEFT JOIN `author` b ON a.`author_id`=b.`id` ORDER BY a.`id` DESC';

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            foreach ($rows as $rawData) {
                $rawData['content'] = mb_strimwidth($rawData['content'], 0, 200) . '...';
                $res[] = $this->buildData($rawData, new ArticleModel());
            }
        }
        return $res;
    }

    public function getArticlesByRubricId(int $rubricId, $res = [], bool $withChildren = true): array
    {
        $rubricRepository = new RubricRepository();
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title`, ' .
            ' a.`content`, ' .
            ' a.`author_id`, ' .
            ' CONCAT(b.`lastname`, \' \', b.`firstname`, \' \', b.`middlename`) as author_name ' .
            'FROM `article` a ' .
            'LEFT JOIN `author` b ON a.`author_id`=b.`id` ' .
            'LEFT JOIN `article_rubric` c ON c.`article_id`=a.`id` ' .
            'WHERE c.`rubric_id`=:rubric_id';

        $result = $this->db->prepare($query);
        $result->execute([':rubric_id' => $rubricId]);
        if ($rows = $result->fetchAll()) {
            foreach ($rows as $rawData) {
                $rawData['content'] = mb_strimwidth($rawData['content'], 0, 200) . '...';
                $res[] = $this->buildData($rawData, new ArticleModel());
            }
        }
        if ($withChildren && $rubricRepository->hasChildRubric($rubricId)) {
            $children = $rubricRepository->getChildRubrics($rubricId);
            foreach ($children as $childRubric) {
               $res = $this->getArticlesByRubricId($childRubric->getId(), $res);
            }
        }
        return $res;
    }


    public function getArticleById(int $id): ?ArticleModel
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title`, ' .
            ' a.`content`, ' .
            ' a.`author_id`, ' .
            ' CONCAT(b.`lastname`, \' \', b.`firstname`, \' \', b.`middlename`) as author_name ' .
            'FROM `article` a ' .
            'LEFT JOIN `author` b ON a.`author_id`=b.`id` ' .
            'WHERE a.`id`=:id';

        $result = $this->db->prepare($query);
        $result->execute([':id' => $id]);
        if ($row = $result->fetch()) {
            return $this->buildData($row, new ArticleModel());
        }
        return null;
    }

    public function save(ArticleModel $model): bool
    {
        if (!$model->getId()) {
            return $this->add($model);
        } else {

            //Here can call call update method
            return false;
        }
    }

    private function add(ArticleModel $model): bool
    {
        if ($model->validate()) {
            $query = 'INSERT INTO `article`' .
                '(`title`, `content`, `author_id`)' .
                'VALUES(:title,:content,:author_id)';
            $result = $this->db->prepare($query);
            if ($result->execute([
                ':title' => $model->getTitle(),
                ':content' => $model->getContent(),
                ':author_id' => $model->getAuthorId()
            ])) {
                $this->lastInsertId = $this->db->lastInsertId();
                $query = 'INSERT INTO `article_rubric` (`article_id`,`rubric_id`) ' .
                    'VALUES(:article_id, :rubric_id)';
                $result = $this->db->prepare($query);
                return $result->execute([
                    ':article_id' => $this->getLastInsertId(),
                    ':rubric_id' => $model->getRubricId()
                ]);
            }
        }
        return false;
    }
}