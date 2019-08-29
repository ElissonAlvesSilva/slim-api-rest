<?php declare(strict_types=1);

require __DIR__ . '../../vendor/autoload.php';

$settings = require 'config/application.php';

$baseDir = __DIR__ . '/';
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv = Dotenv\Dotenv::create($baseDir);
    $dotenv->load();
}

// Contruct League container.
$container = new \League\Container\Container;
$container->delegate(new \Slim\Container($settings));

// Enable auto wiring.
$container->delegate(
    new \League\Container\ReflectionContainer
);

$app = new \Slim\App($container);
$container = $app->getContainer();

require __DIR__ . '/dependencies/dependencies.php';
require __DIR__ . '/routes/routes.php';
