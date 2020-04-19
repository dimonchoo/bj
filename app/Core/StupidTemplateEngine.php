<?php


namespace App\Core;

class StupidTemplateEngine
{
    public $viewsFolder;
    public function __construct()
    {
        global $config;
        $this->viewsFolder = $config->getConfig('viewsFolder');
    }

    public function render(string $filename, $data)
    {
        $file = $this->viewsFolder . DIRECTORY_SEPARATOR . $filename . '.php';
        if(file_exists($file)) {
            ob_start();
            extract($data);
            require_once $this->viewsFolder  . DIRECTORY_SEPARATOR . 'header.html';
            require_once $file;
            require_once $this->viewsFolder  . DIRECTORY_SEPARATOR . 'footer.html';
            echo ob_get_clean();
            return;
        }
    }

    public function sentJson(array $data)
    {
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($data);
        return;
    }
}