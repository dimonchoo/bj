<?php

namespace App\Model;
use App\Core\Database as DB;
use App\Core\Model;

class Task extends Model
{
    /**
     * @var int Сколько записей выводить
     */
    private $limit = 3;

    public function __construct()
    {
        parent::setRules(self::rules());
    }

    /**
     * @return array Правила валидации
     */
    public static function rules()
    {
        return [
            'name' => ['string' => true, 'empty' => false],
            'email' => ['email' => true, 'empty' => false],
            'task_text' => ['string' => true, 'empty' => false],
            'status' => ['bool' => true, 'auth' => true]
        ];
    }

    /**
     * @return array Вывод записей, с учетом разбивки на страницы
     */
    public function getTasksWithPagination() : array
    {
        $count = DB::query('SELECT count(*) AS c FROM task')->fetch();
        $tasks = DB::query('SELECT * FROM task LIMIT :limit OFFSET :page', [
            ':page' => !is_numeric($_GET['page']) ? 0 : $_GET['page'] * $this->limit,
            ':limit' => $this->limit
        ])->fetchAll();
        return [
            'tasks' => $tasks,
            'sumPage' => ceil($count['c'] / $this->limit)
        ];
    }

    public function addTask(array $data)
    {
        if ($this->validate($data)) {
            $query = 'INSERT INTO task (name, email, task_text)
    VALUES (:name, :email, :task_text)';
            $prepare = DB::getInstance()->getConnection()
                ->prepare($query);
            $res = $prepare->execute([
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':task_text' => $data['task_text']
            ]);

            echo json_encode($res);
            return $res;
        }else{
            echo json_encode($this->getErrors());
            return $this->getErrors();
        }
    }
}