<?php

namespace App\Controller;
use App\Core\Controller;

class NotFound extends Controller
{
    static function message(string $msg = null)
    {
        header("Status: ", true, 404);
        echo $msg ?? 'Страница не найдена';
        return;
    }
}