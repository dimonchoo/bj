<?php


namespace App\Core;
use App\Core\StupidTemplateEngine as STE;

class Controller
{
    public $view;
    public function __construct()
    {
        $this->view = new StupidTemplateEngine();
    }
}