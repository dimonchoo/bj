<?php

namespace App\Model;
use App\Core\Database as DB;
use App\Core\Model;
use App\Core\RouterService;

class User extends Model
{
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
            'username' => ['empty' => false],
            'password' => ['empty' => false]
        ];
    }

    public function checkAuth(array $data)
    {
        if ($this->validate($data)) {
            $user = DB::query('
                SELECT * FROM users WHERE username = :username', [
                ':username' => $data['username']
            ])->fetch();

            $isRightUser = password_verify($data['password'], $user['password']);

            if ($isRightUser !== true) {
                $this->setError('custom', 'Неправильно введены данные');
                echo json_encode($this->getErrors());
                return $isRightUser;
            }else{
                setcookie("admin", 'траляля', time()+3600, '/');
            }
            echo json_encode($isRightUser);
            return $isRightUser;
        }else{
            echo json_encode($this->getErrors());
            return $this->getErrors();
        }
    }
}