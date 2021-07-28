<?php

namespace Palayop\Demomvc\Controllers;

use Palayop\Demomvc\Core\Controller;
use Palayop\Demomvc\Core\Router;
use Palayop\Demomvc\Core\Session;
use Palayop\Demomvc\Middlewares\AuthMiddleware;

class UserController extends Controller
{
    public function __construct()
    {
        $this->setMiddleware(new AuthMiddleware(['exceptions' => ['loginAuth']]));
        $this->setLayout('layout');
    }

    public function loginAuth()
    {
        Session::set(Session::AUTH_USER, 'palayop');
        Router::redirectTo('/home/index');
    }

    public function index()
    {
        $this->view('index');
    }

    public function logout()
    {
        Session::remove(Session::AUTH_USER);
        session_destroy();
        Router::redirectTo('/home/index');
    }

    public function save($request)
    {
        $this->json(Router::getRequest());
    }
}