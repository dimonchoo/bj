<?php

/**
 * Разбираем URI и вызываем контролер
 */
namespace App\Core;
use App\Core\Interfaces\Service;
use App\Controller\NotFound;

class RouterService implements Service
{
    /**
     * @var mixed Исходная строка
     */
    private $uri;

    /**
     * @var array Массив с частями URI
     */
    private $uriPart = [];
    private $config;

    public function __construct(Service $config)
    {
        $this->config = $config;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->parseUri();
    }

    /**
     * Обработка контролера и действия. Вложенность не делаем, только 1 уровень
     * контролеров.
     * Очищаем от параметров
     * @return void
     */
    public function parseUri() : void
    {
        if (!empty($this->uri)) {
            $parts = preg_split('@/@', $this->uri, NULL, PREG_SPLIT_NO_EMPTY);
            if (array_key_exists(0, $parts)) {
                $this->uriPart['controller'] = strtok($parts[0], '?');
            }else{
                $this->uriPart['controller'] = $this->config->getConfig('startPage');
            }

            if (array_key_exists(1, $parts)) {
                $this->uriPart['action'] = strtok($parts[1], '?');
            }else{
                $this->uriPart['action'] = $this->config->getConfig('defaultMethod');
            }

            $this->uriPart['fullUri'] = $this->config->getConfig('domain')
                . $this->uri;
        }
    }

    public function resolve()
    {
        if (empty($this->uriPart)) {
            return self::redirect($this->config->getConfig('domain') .
                DIRECTORY_SEPARATOR . $this->config->getConfig('startPage')
            );
        }else{
            $path = $this->config->getConfig('controllerFolder')
                . DIRECTORY_SEPARATOR . ucfirst($this->uriPart['controller']) . '.php';
            if (file_exists($path)) {
                $ns = "\\App\\Controller\\" . ucfirst($this->uriPart['controller']);
                $controller = new $ns();
                if (method_exists($controller, $this->uriPart['action'])) {
                    return $controller->{$this->uriPart['action']}();
                }else{
                    return NotFound::message();
                }
            }else{
                return NotFound::message();
            }
        }
    }

    /**
     * Перенаправление
     * @param string $url
     */
    static function redirect(string $url, int $code = 302)
    {
        return header("Location: " . $url, true, $code);
    }
}