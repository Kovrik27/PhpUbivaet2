<?php

namespace App\Views;

use App\Core\CoreView;

class FrontView extends CoreView
{
    public function showIndexPage()
    {
        $title = 'Главная страница';
        $description = 'Описание Главной страницы';
        echo $this->twig->render('index.twig', ['title' => $title, 'description' => $description]);
    }

    public function renderArticlesListPage($articles)
    {
        $title = 'Блог на Json';
        $description = 'Вывод всех статей';
        echo $this->twig->render('articles-list.twig',compact('title', 'description', 'articles'));
    }
    public function renderSingleArticlePage($article)
    {
        $title = 'Блог на Json';
        $description = 'Вывод стастьи';
        echo $this->twig->render('single-article-page.twig',compact('title', 'description', 'article'));
    }

    public function showLoginPage()
    {
        echo $this->twig->render('/forms/login-form.twig');
    }

}