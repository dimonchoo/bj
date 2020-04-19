<?php
namespace App\Core;
use App\Core\Interfaces\Service;

class ConfigService implements Service
{
    private $config;
    public function __construct(array $data)
    {
        $this->config = $data;
    }

    /**
     * Возврат всех опций
     * @return array
     */
    public function getConfigs() : array
    {
        return $this->config;
    }

    /**
     * Возврат конкретной опции
     * @return mixed
     */
    public function getConfig(string $value)
    {
        return $this->config[$value] ?? null;
    }
}