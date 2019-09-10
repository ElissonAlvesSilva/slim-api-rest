<?php 

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Classe;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class ClassesController extends BaseController
{
  protected $container;

  public function __construct($container) {
    $this->container = $container;
  }

  public function getAll($request, $response, $args)
  {
    $all = Classe::all();
    return $response->getBody()->write($all->toJson());
  }

  public function getById($request, $response, $args)
  {
    $this->setParams($request, $response, $args);
    try {
      $class = Classe::where('idClasse', $this->args['idClasse'])->firstOrFail();
      return $this->jsonResponse($class, http_response_code());
    } catch (ModelNotFoundException $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function create($request, $response, $args)
  {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $duplicate = Classe::where('Descricao', $input['Descricao'])->first();

    if (!$duplicate) {
      if($request->getAttribute('has_errors')) {
        $code = 400;
        $errors = $request->getAttribute('errors');

        return $this->jsonResponse($errors, $code);
      }

      $class = Classe::create($input);
      return $this->jsonResponse($class, http_response_code());
    }
    return $this->jsonResponse('duplicated class', 400);
  }

  public function update($request, $response, $args)
  {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();

    if($request->getAttribute('has_errors')) {
      $code = 400;
      $errors = $request->getAttribute('errors');

      return $this->jsonResponse($errors, $code);
    }

    $class = Classe::where('idClasse', $this->args['idClasse'])->update($input);
    return $this->jsonResponse($class, http_response_code());
  }

  public function delete($request, $response, $args)
  {
    $this->setParams($request, $response, $args);
    $class = Classe::where('idClasse', $this->args['idClasse'])->delete();
    return $this->jsonResponse($class, http_response_code());
  }
}
