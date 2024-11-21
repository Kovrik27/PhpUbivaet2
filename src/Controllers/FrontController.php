<?php

namespace App\Controllers;

use App\Models\Article;
use App\Traits\Auth;
use App\Views\FrontView;
use Laminas\Diactoros\ServerRequest;
use App\Core\Helper as h;

class FrontController
{
    use Auth;
    protected $View;
    private  $Model;

    public function __construct()
    {
        $this->View = new FrontView();
        $this->Model = new Article();
    }
    public function index()
    {
        $this->View->showIndexPage();
    }

    public function showArticlesListPage()
    {
        $articles = $this->Model->getAll();
        $this->View->renderArticlesListPage($articles);
    }
    public function showSingleArticlePage($id)
    {
        $article = $this->Model->find($id);
        $this->View->renderSingleArticlePage($article);
    }

    public function loginPage()
    {
        $this->View->showLoginPage();
    }
    public function login(ServerRequest $request)
    {
        $email = $request->getParsedBody();

        define('ADMIN_EMAIL','admin@admin.com');
        if(!empty($_POST['email']))
        {
            if ($_POST['email'] === ADMIN_EMAIL)
            {
                $_SESSION['admin'] = ADMIN_EMAIL;
                echo 'Авторизация прошла успешно! Всё ещё врёшь себе?';
                h::goUrl('/admin/articles');
            }
            else
            {
                echo 'Неверно. Это твой шанс...';
            }

        }
    }

}