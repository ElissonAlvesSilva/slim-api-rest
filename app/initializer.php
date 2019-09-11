<?php
$settings = require 'config/settings.php';

$app = new \Slim\App($settings);
$container = $app->getContainer();
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$capsule->getContainer()->singleton(
  Illuminate\Contracts\Debug\ExceptionHandler::class,
);

$container['db'] = function ($container) use ($capsule){
   return $capsule;
};

$photoDir = '../upload/photo/'; 
$container['upload_directory_photo'] = function ($container) use($photoDir) {
  return $photoDir;
};

$docDir   = '../upload/documents/';
$container['upload_directory_doc'] = function ($container) use($docDir) {
  return $docDir;
};