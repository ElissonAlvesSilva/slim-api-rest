<?php declare(strict_types=1);

require __DIR__ . '../../vendor/autoload.php';

$baseDir = __DIR__ . '/';
$envFile = $baseDir . '.env';
if (file_exists($envFile)) {
    $dotenv = Dotenv\Dotenv::create($baseDir);
    $dotenv->load();
}

require __DIR__ . '/dependencies/dependencies.php';

$app = new \Slim\App($container);
$container = $app->getContainer();


require __DIR__ . '/routes/routes.php';
