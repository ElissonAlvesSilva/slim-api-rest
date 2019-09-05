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

  $app->group('/classes', function () use ($app, $namespace) {
    require __DIR__ . '/../validators/classe.php';

    $app->get('', $namespace.'\ClassesController:getAll');
    $app->get('/[{idClasse}]', $namespace.'\ClassesController:getById');
    $app->post('', $namespace.'\ClassesController:create')->add(new \DavidePastore\Slim\Validation\Validation($classe));
    $app->put('/[{idClasse}]', $namespace.'\ClassesController:update')->add(new \DavidePastore\Slim\Validation\Validation($classe));
    $app->delete('/[{idClasse}]', $namespace.'\ClassesController:delete');
  });

});
