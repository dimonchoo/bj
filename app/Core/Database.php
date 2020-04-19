<?php

/**
 * Класс для работы с БД
 */
namespace App\Core;
class Database extends Singleton
{
    /**
     * Создаем подключение
     */
    private $connection;
    protected function __construct()
    {
        $this->connection = new \PDO("sqlite:app1.db");
    }

    /**
     * Получаем подключение
     * @return \PDO
     */
    public function getConnection() : \PDO
    {
        return $this->connection;
    }

    /**
     * Выборка и подготовка данных.
     *
     * @param string $query
     * @param array $data
     * @return mixed
     */
    public static function query(string $query, array $data = [])
    {
        $prepare = self::getInstance()->getConnection()->prepare($query);
        foreach ($data as $key => $value) {
            $prepare->bindValue($key, $value);
        }
        $prepare->execute();
        $prepare->setFetchMode(\PDO::FETCH_ASSOC);
        return $prepare;
    }
}