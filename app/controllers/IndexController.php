<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 27.12.2018
 * Time: 16:57
 */

namespace App\Controllers;

use App\Components\AbstractController;
use App\Repositories\AuthorRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\RubricRepository;

class IndexController extends AbstractController
{
    public function indexAction(): void
    {
        $articleRepository = new ArticleRepository();
        $rubricRepository = new RubricRepository();

        $this->data['articles'] = $articleRepository->getArticles();
        $this->data['rubrics'] = $rubricRepository->getRubrics();
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