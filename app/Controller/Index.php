<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Task;

class Index extends Controller
{
    public function index()
    {
        $task = new Task();
        return $this->view->render('index', $task->getTasksWithPagination());
    }

    public function addTask()
    {
        $task = new Task();
        return $task->addTask($_GET);
    }
}