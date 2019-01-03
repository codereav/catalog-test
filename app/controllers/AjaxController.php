<?php
/**
 * Created by PhpStorm.
 * User: codereav
 * Date: 02.01.2019
 * Time: 12:35
 */

namespace App\Controllers;

use App\Components\AbstractController;
use App\Models\ArticleModel;
use App\Models\AuthorModel;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\RubricRepository;

class AjaxController extends AbstractController
{
    private $errors = [];

    public function __construct()
    {
        try {
            parent::__construct();
            $token = $this->request->post('token');
            if (null === $this->request->server('HTTP_X_REQUESTED_WITH') ||
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest' ||
                $this->request->session('csrf_token') !== $token
            ) {
                throw new \Exception('Invalid request');
            }
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }
    }

    public function articleAddAjaxAction(): void
    {
        $html = '';
        try {
            if ($this->request->isNotEmpty('post') && empty($this->errors)) {
                $authorRepository = new AuthorRepository();
                $author = new AuthorModel();
                $articleRepository = new ArticleRepository();
                $rubricRepository = new RubricRepository();
                $article = new ArticleModel();

                $author->setLastname($this->request->getSafeString($this->request->post('lastname')) ?? '');
                $author->setFirstname($this->request->getSafeString($this->request->post('firstname')) ?? '');
                $author->setMiddlename($this->request->getSafeString($this->request->post('middlename')) ?? '');

                // Check if author exists and get id, or add new author and get id
                if ($authorRepository->isAuthorExists($author->getLastname(), $author->getFirstname(),
                    $author->getMiddlename())) {
                    $author = $authorRepository->getByFIO($author->getLastname(), $author->getFirstname(),
                        $author->getMiddlename());
                    if ($author) {
                        $authorId = $author->getId();
                    } else {
                        throw new \Exception('Something went wrong when try to get author by FIO');
                    }
                } else {
                    $authorRepository->save($author);
                    $authorId = $authorRepository->getLastInsertId();
                }

                // Check if rubric exists or throw exception
                if ($this->request->post('rubric_id') &&
                    $rubricRepository->isRubricExists((int)$this->request->post('rubric_id'))) {
                    $rubricId = (int)$this->request->post('rubric_id');
                } else {
                    throw new \Exception('Wrong rubric id!');
                }

                $article->setTitle($this->request->post('title') ?? '');
                $article->setContent($this->request->getSafeHtml($this->request->post('content')) ?? '');
                $article->setAuthorId($authorId);
                $article->setRubricId($rubricId);
                if (!$articleRepository->save($article)) {
                    throw new \Exception('Article saving failed!');
                }

                $articleData = $articleRepository->getArticleById($articleRepository->getLastInsertId(true));
                $this->view->addPart('articles-list_one');
                $html = $this->view->render(['article' => $articleData], true);
            }
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }
        echo json_encode([
            'errors' => $this->errors,
            'html' => $html
        ]);
    }

    public function getArticlesByRubricIdAjaxAction(int $rubricId)
    {
        $html = '';
        $rubricTitle = '';
        try {
            if (empty($this->errors)) {
                $articleRepository = new ArticleRepository();
                $rubricRepository = new RubricRepository();
                if ($rubricRepository->isRubricExists($rubricId)) {
                    $mainRubric = $rubricRepository->getRubricById($rubricId);
                    $rubricTitle = $mainRubric->getTitle();
                    $articles = $articleRepository->getArticlesByRubricId($rubricId);
                    $this->view->addPart('articles-list');
                    $html = $this->view->render(['articles' => $articles], true);
                } else {
                    throw new \Exception('Rubric #' . $rubricId . ' is not exists!');
                }
            }
        } catch (\Exception $e) {
            $this->errors[] = $e->getMessage();
        }

        echo json_encode([
            'errors' => $this->errors,
            'html' => $html,
            'rubricTitle' => $rubricTitle
        ]);
    }
}