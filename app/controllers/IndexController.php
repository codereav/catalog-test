<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 16:57
 */

namespace App\Controllers;

use App\Components\AbstractController;
use App\Components\View;
use App\Models\AuthorModel;
use App\Repositories\AuthorRepository;
use App\Models\ArticleModel;
use App\Repositories\ArticleRepository;
use App\Repositories\RubricRepository;

class IndexController extends AbstractController
{
    public function indexAction(): void
    {
        $rubricRepository = new RubricRepository();
        $rubricRepository->findRubrics();
        $this->data['rubrics'] = $rubricRepository->getAll();

        $articleModel = new ArticleModel();
        $articleRepository = new ArticleRepository($articleModel);
        $articleRepository->findArticles();
        $this->data['articles'] = $articleRepository->getAll();

        $this->view->addPart('common' . DS . 'header');
        $this->view->addPart('form');
        $this->view->addPart('rubrics-links');
        $this->view->addPart('articles-list');
        $this->view->addPart('common' . DS . 'footer');
        $this->view->render($this->data);
    }

    public function articleViewAction(int $id): void
    {
        //echo 'SHOW ARTICLE ' . $id;
    }
}