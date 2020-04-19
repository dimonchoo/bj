<?php declare(strict_types=1);

namespace App\Core;
use App\Core\Interfaces\Service;

class ServiceLocator {

    private $services = [];
    public function get(string $id) {
        return $this->services[$id] ?? null;
    }

    public function has(string $id) : bool {
        return isset($this->services[$id]);
    }

    public function register(string $id, Service $service) : void {
        $this->services[$id] = $service;
    }
}