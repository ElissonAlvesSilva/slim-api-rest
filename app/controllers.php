<?php 
$container['SindicalizadosController'] = function ($container) {
  return App\Controllers\SindicalizadosController($container);
};

$container['ClasseController'] = function ($container) {
  return App\Controllers\ClassesController($container);
};