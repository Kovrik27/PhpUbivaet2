<?php

namespace App\Views;

use App\Core\CoreView;

class AdminView extends CoreView
{
    public function __construct()
    {
        $this->setLoader('template/admin/');
        $this->twig = new \Twig\Environment($this->loader, []);
    }

    public function renderIndexPage()
    {
        $pagetitle = "Admin Panel";
        return $this->twig->render('layout.twig',compact('pagetitle'));
    }

    public function showArticlesTable(array $articles)
    {
        $pagetitle = "Список статей";
        return $this->twig->render('/articles/index-table.twig',compact('articles','pagetitle'));
    }

    public function renderCreateArticlePage()
    {
        $pagetitle = "Create New Article";
        return $this->twig->render('/articles/create.twig',compact('pagetitle'));
    }

    public function renderEditeArticlePage($article)
    {

        $pagetitle = "Edit Article";
        return $this->twig->render('/articles/edit.twig',compact('pagetitle','article'));
    }

}