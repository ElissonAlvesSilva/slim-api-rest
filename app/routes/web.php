<?php declare(strict_types=1);

$controllerNamespace = 'App\Controllers';

$app->get('/', $controllerNamespace.'\SindicalizadosController:getAll');