<?php 
// Contruct League container.
$container = new \League\Container\Container;
$container->delegate(new \Slim\Container($settings));

// Enable auto wiring.
$container->delegate(
    new \League\Container\ReflectionContainer
);

require './database.php';