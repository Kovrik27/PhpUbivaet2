<?php

namespace App\Controllers;

use App\Models\Article;
use App\Views\AdminView;
use Laminas\Diactoros\ServerRequest;
use App\Core\Helper as h;

class AdminController
{
    protected $View;
    private  $Article;

    public function __construct()
    {
        $this->View = new AdminView();
        $this->Article = new Article();
    }

    public function index()
    {

        echo $this->View->renderIndexPage();
    }
    public function showCreateArticlePage()
    {

        echo $this->View->renderCreateArticlePage();
    }




    public function AddArticle(ServerRequest $request)
    {
//        $article = $request->getParsedBody();
//        if (!empty($article['title']) && !empty($article['content'])&& !empty($article['image']))
//        {
//            $this->Article->create($article);
//
//            if ($this->Article->create($article))
//            {
//                h::goUrl('/admin/articles');
//            }
//            echo 'error';
//
//        }
//        else
//        {
//            h::goUrl('/admin/article/add');
//        }

        $message = null;
        $parsedBody = $request->getParsedBody();
        $filtered = \GUMP::filter_input($parsedBody, $this->Article->filter);
        unset($filtered['id']);
        $is_valid = \GUMP::is_valid($filtered, $this->Article->filter);

        if($is_valid === true){
            if($this->Article->create($filtered) == null)
            {
                $message = 'Ура, ты смог добавить статью. А как насчёт наладить свою жизнь? Ты сидишь здесь и пишешь код, зачем? Неужели у тебя нет проблем, которые надо решать? Не ври себе';
            }
            else
            {
                $message = $is_valid;
            }
        }
        $this->setMessage($message);
        return $this->articles($message);
    }

    public function UpdateArticle(ServerRequest $request)
    {
//        $article = $request->getParsedBody();
//        if (!empty($article['title']) && !empty($article['content'])&& !empty($article['image']))
//        {
//            $this->Article->update($article);
//            if ($this->Article->update($article))
//            {
//                h::goUrl('/admin/articles');
//            }
//            echo 'error';
//
//        }
//        else
//        {
//            h::goUrl('/admin/article/'.$article['id'].'/edit');
//        }

    }

    public function DeleteArticle($id)
    {
        if($this->Article->delete($id))
        {
            h::goUrl('/admin/articles');
        }
        else
        {
           echo 'error';
        }
    }
    public function showEditeArticlePage($id)
    {
        $article = $this->Article->find($id);
        echo $this->View->renderEditeArticlePage($article);
    }

    public function showArticlesTable()
    {
        $articles = $this->Article->getAll();
        echo $this->View->showArticlesTable($articles);
    }

}