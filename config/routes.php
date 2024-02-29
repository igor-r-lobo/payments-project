<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use App\Controller\UserController;
use App\Controller\TransactController;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::addGroup('/users', function () {
    Router::post('', [UserController::class, 'store']);
});

Router::addGroup('/transaction', function (){
    Router::post('/deposit',[TransactController::class,'deposit']);
    Router::post('/transfer',[TransactController::class,'transfer']);
});