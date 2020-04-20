<?php
namespace App\Core;

class Model
{
    private $isString;
    private $isNumber;
    private $isNumeric;
    private $isEmpty;
    private $isBool;
    private $length;
    private $errors = [];

    private $messages = [
        'string' => 'Поле должно быть строкой',
        'empty' => 'Поле должно быть заполнено',
        'bool' => 'Поле должно быть булева типа',
        'email' => 'Поле должно быть корректным имейлом',
        'integer' => 'Поле должно быть числом',
        'auth' => 'Доступно после авторизации'
//        'maxLength' => 'Поле превышает допустимое количество символов',
    ];

    private $rules = [];

    /**
     * @param array $rules
     */
    public function setRules(array $rules): void
    {
        $this->rules = $rules;
    }


    /**
     * @param array $data
     * @return bool|string[]
     */
    public function validate(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->checkRule($key, $value);
        }
        return empty($this->errors);
    }

    private function checkRule(string $key, $value)
    {
        if (array_key_exists($key, $this->rules)) {
            foreach ($this->rules[$key] as $ruleKey => $ruleVal) {
                if ($this->validator($value)[$ruleKey] !== $ruleVal) {
                    $this->errors[$key] = $this->messages[$ruleKey];
                }
            }
        }
    }

    private function validator($val)
    {
        return [
            'integer' => is_numeric($val) !== false,
            'string' => is_string($val),
            'empty' => empty(trim($val)),
            'bool' => is_bool($val),
            'auth' => array_key_exists('admin', $_COOKIE),
            'email' => filter_var($val, FILTER_VALIDATE_EMAIL) !== false
        ];
    }

    /**
     * @return array Получить все сообщения об ошибках
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Добавление кастомной ошибки
     * @param string $key
     * @param string $val
     */
    public function setError(string $key, string $message)
    {
        $this->errors[$key] = $message;
    }
}