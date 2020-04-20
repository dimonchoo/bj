<?php

namespace App\Controller;
use App\Core\Controller;
use App\Model\Task;

class Index extends Controller
{
    public function index()
    {
        $task = new Task();
        return $this->view->render('index');
    }

    public function getTasks()
    {
        $task = new Task();
        echo json_encode($task->getTasks());
    }

    public function addTask()
    {
        $task = new Task();
        return $task->addTask($_GET);
    }

    public function updateStatus()
    {
        $task = new Task();
        return $task->updateStatus($_GET);
    }

    public function updateText()
    {
        $task = new Task();
        return $task->updateText($_GET);
    }
}