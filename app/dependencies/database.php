<?php 
$container->add('Illuminate\Database\Capsule\Manager', function() {
  $dbconfig = require '../config/settings.php';
  $capsule = new \Illuminate\Database\Capsule\Manager;
  $capsule->addConnection([
      'driver' => 'mysql',
      'host' => $dbconfig['hostname'],
      'database' => $dbconfig['database'],
      'username' => $dbconfig['username'],
      'password' => $dbconfig['password'],
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
  ]);

  $capsule->setAsGlobal();
  $capsule->bootEloquent();

  return $capsule;
});