<?php
require_once  __DIR__ . '/../vendor/autoload.php';

use App\Core\App;

$configFile = require_once __DIR__ . '/../app/config.php';

// Я знаю, что это неправильно)
global $config;
$config = new\App\Core\ConfigService($configFile);

$app = new App($config);
$app->run();