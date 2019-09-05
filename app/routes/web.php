<?php declare(strict_types=1);

$namespace = 'App\Controllers';

$app->group('/siscad/v1', function () use ($app, $namespace) {
  $app->group('/sindicalizado', function () use ($app, $namespace) {
    require __DIR__ . '/../validators/sindicalizados.php';

    $app->get('', $namespace.'\SindicalizadosController:getAll');
    $app->get('/[{idSindicalizado}]', $namespace.'\SindicalizadosController:getById');
    $app->post('', $namespace.'\SindicalizadosController:create')
      ->add(new \DavidePastore\Slim\Validation\Validation($sindicalizado));
    $app->post('/upload', $namespace.'\SindicalizadosController:upload');
    $app->put('/[{idSindicalizado}]', $namespace.'\SindicalizadosController:update');
  });
});
