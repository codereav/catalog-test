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
            'LEFT JOIN `author` b ON a.`author_id`=b.`id` ';

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            foreach ($rows as $rawData) {
                $res[] = $this->buildData($rawData, new ArticleModel());
            }
        }
        return $res;
    }

    public function getArticleByRubricId(int $rubricId): ?ArticleModel
    {
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
        if ($row = $result->fetch()) {
            return $this->buildData($row, new ArticleModel());
        }
        return null;
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

    public function add(ArticleModel $model): bool
    {
        if ($model->validate()) {
            $query = 'INSERT INTO `article` a' .
                '(a.`title`, a.`content`, a.`author_id`)' .
                'VALUES(":title",":content",":author_id")';
            $result = $this->db->prepare($query);
            return $result->execute([
                ':title' => $model->getTitle(),
                ':content' => $model->getContent(),
                ':author_id' => $model->getAuthorId()
            ]);
        }
        return false;
    }
}