<?php
/* public/index.php */

// echo "<pre>";
// var_dump($params);
// echo "</pre>";

use Dotenv\Dotenv;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\GroupsList;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$app = new Application(dirname(__DIR__)); 
if($app->isAuth())
{
    $app->router->get('/', [SiteController::class, 'home']);
    $app->router->get('/bookmarkslist', [SiteController::class, 'bookmarkslist']);
    $app->router->get('/newbookmark', [SiteController::class, 'newbookmark']);
    $app->router->post('/newbookmark', [SiteController::class, 'newbookmark']);
    $app->router->get('/groupslist', [GroupsList::class, 'groupslist']);
    $app->router->get('/newgroup', [SiteController::class, 'newgroup']);
    $app->router->post('/newgroup', [SiteController::class, 'newgroup']);
    $app->router->get('/viewgroup', [SiteController::class, 'viewgroup']);
    $app->router->get('/editgroup', [SiteController::class, 'editgroup']);
    $app->router->post('/editgroup', [SiteController::class, 'editgroup']);
    $app->router->get('/editbookmark', [SiteController::class, 'editbookmark']);
    $app->router->post('/editbookmark', [SiteController::class, 'editbookmark']);

    $app->router->get('/logout', [AuthController::class, 'logout']);
}
else
{
    $app->router->get('/', [AuthController::class, 'login']);
    $app->router->post('/', [AuthController::class, 'login']);
}
$app->run();