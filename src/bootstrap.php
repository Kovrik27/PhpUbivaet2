<?php

declare(strict_types=1);

use MiladRahimi\PhpRouter\Router;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use Laminas\Diactoros\Response\HtmlResponse;
use App\Views\ErrorsView;

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$error = new ErrorsView();

$router = Router::create();

$router->get('/', [\App\Controllers\FrontController::class, 'index']);
$router->get('/blog', [\App\Controllers\FrontController::class, 'showArticlesListPage']);
$router->get('/blog/{id}', [\App\Controllers\FrontController::class, 'showSingleArticlePage']);

$router->get('/login', [\App\Controllers\FrontController::class, 'loginPage']);
$router->post('/signin', [\App\Controllers\FrontController::class, 'login']);

$router->get('/admin', [\App\Controllers\AdminController::class, 'index']);

$router->get('/admin/articles', [\App\Controllers\AdminController::class, 'showArticlesTable']);
$router->get('/admin/article/add', [\App\Controllers\AdminController::class, 'showCreateArticlePage']);
$router->get('/admin/article/{id}/edit', [\App\Controllers\AdminController::class, 'showEditeArticlePage']);
$router->post('/admin/article/add', [\App\Controllers\AdminController::class, 'AddArticle']);
$router->post('/admin/article/update', [\App\Controllers\AdminController::class, 'UpdateArticle']);
$router->get('/admin/article/{id}/delete', [\App\Controllers\AdminController::class, 'DeleteArticle']);
//$router->post('/admin/article/delete', [\App\Controllers\AdminController::class, 'DeleteArticle']);



$router->dispatch();

//try {
//
//} catch (RouteNotFoundException $e) {
//    // It's 404!
//    $router->getPublisher()->publish( new HtmlResponse( $error->render404Page(), 404));
//} catch (Throwable $e) {
//    // Log and report...
//    //$router->getPublisher()->publish( new HtmlResponse( $error->render500Page(), 500));
//}