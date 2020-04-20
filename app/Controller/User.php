<?php

namespace App\Controller;
use App\Core\Controller;
use App\Core\RouterService;

class User extends Controller
{
    public function auth()
    {
        return $this->view->render('auth');
    }

    public function checkAuth()
    {
        $user = new \App\Model\User();
        return $user->checkAuth($_POST);
    }

    public function exit()
    {
        unset($_COOKIE["admin"]);
        setcookie("admin", "", time()-3600, '/');
        return RouterService::redirect('/index/index', 200);
    }
}