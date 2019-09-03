<?php 

namespace App\Controllers;

use App\Models\Sindicalizado;
class SindicalizadosController
{
  public function getAll($request, $response)
  {
    $all =  Sindicalizado::all();
    return $response->getBody()->write($all->toJson());
  }
}
