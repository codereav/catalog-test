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
    private $model;

    public function __construct(ArticleModel $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function findArticles(): void
    {
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
            $this->data = $rows;
        }
    }

    public function findArticleByRubricId(): void
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
            'WHERE c.`rubric_id`=' . $this->model->getRubricId();

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            $this->data = $rows;
        }
    }

    public function findArticleById(): void
    {
        $query = 'SELECT ' .
            'a.`id`, ' .
            ' a.`title`, ' .
            ' a.`content`, ' .
            ' a.`author_id`, ' .
            ' CONCAT(b.`lastname`, \' \', b.`firstname`, \' \', b.`middlename`) as author_name ' .
            'FROM `article` a ' .
            'LEFT JOIN `author` b ON a.`author_id`=b.`id` ' .
            'WHERE a.`id`=' . $this->model->getId();

        $result = $this->db->query($query);
        if ($rows = $result->fetchAll()) {
            $this->data = $rows;
        }
    }
}