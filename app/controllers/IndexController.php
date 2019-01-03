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
        $rubricRepository = new RubricRepository();

        $this->data['rubrics'] = $rubricRepository->getRubrics();
        $this->data['articles'] = (new ArticleRepository())->getArticles();

        $rubricTreeArray = $rubricRepository->buildTreeArray($this->data['rubrics']);
        $this->data['rubricsUlHtml'] = $rubricRepository->getTreeHtml($rubricTreeArray);

        $this->view->addPart('common' . DS . 'header');
        $this->view->addPart('form');
        $this->view->addPart('rubrics-links');
        $this->view->addPart('articles-list');
        $this->view->addPart('common' . DS . 'footer');
        $this->view->render($this->data);
    }

    public function articleViewAction(int $id): void
    {
        $this->data['article'] = (new ArticleRepository())->getArticleById($id);

        $this->view->addPart('common' . DS . 'header');
        $this->view->addPart('article');
        $this->view->addPart('common' . DS . 'footer');
        $this->view->render($this->data);
    }
}