<?php 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\PensionistaHelper;
use App\Helpers\DependentesHelper;

use App\Models\Sindicalizado;
use App\Models\Classe;

use App\Helpers\Helpers;

class ReportController extends BaseController
{

  public function getById($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $id = $this->args['idSindicalizado'];
    try {
      $sindicalizado = Sindicalizado::where('idSindicalizado', $id)->firstOrFail();
      $sindicalizado = $this->populateData($sindicalizado);
      return $this->jsonResponse($sindicalizado, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }
  public function getByMatricula($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $matricula = $input['matricula'];
    try {
      $sindicalizados = Sindicalizado::where('Matricula', $matricula)
                                    ->orWhere('Matricula', 'like', '%'.$matricula.'%')
                                    ->orderBy('Nome', 'ASC')
                                    ->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function getByCategory($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $category = $input['categoria'];
    try {
      $sindicalizados = Sindicalizado::where('Categoria', $category)
                                    ->orderBy('Nome', 'ASC')
                                    ->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function getByClass($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $classe = $input['classe'];
    try {
      $sindicalizados = Sindicalizado::where('Classe_idClasse', $classe)
                                    ->orderBy('Nome', 'ASC')
                                    ->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function getByStatusTJAM($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $status = $input['tjam'];
    try {
      $sindicalizados = Sindicalizado::where('Status', $status)
                                    ->orderBy('Nome', 'ASC')
                                    ->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function getByStatusSintjam($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $status = $input['sintjam'];
    try {
      $sindicalizados = Sindicalizado::where('Status_Sint', $status)
                                    ->orderBy('Nome', 'ASC')
                                    ->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function getByPaymentType($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $fpg = $input['pagamento'];
    try {
      $sindicalizados = Sindicalizado::where('Forma_Pagamento', $fpg)
                                    ->orderBy('Nome', 'ASC')
                                    ->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function getByLocal($request, $response, $args) {
    $this->setParams($request, $response, $args);
    $input = $this->getInput();
    $local = $input['local'];
    try {
      $sindicalizados = Sindicalizado::where('Local', $local)
                                    ->orderBy('Nome', 'ASC')
                                    ->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  public function getAll($request, $response, $args) {
    $this->setParams($request, $response, $args);
    try {
      $sindicalizados = Sindicalizado::orderBy('Nome', 'ASC')->get();
      foreach ($sindicalizados as $key => $value) {
        $sindicalizados[$key] = $this->populateData($value);
      }
      return $this->jsonResponse($sindicalizados, http_response_code());
    } catch(\Exception $e) {
      return $this->jsonResponse($e->getMessage(), 400);
    }
  }

  private function populateData($param) {
    $id = $param['idSindicalizado'];
    $param['Dependentes'] = DependentesHelper::getDependentes($id);
    $param['Pensionista'] = PensionistaHelper::getPensionista($id);
    $param['Classe'] = Classe::where('idClasse', $param['Classe_idClasse'])->get();
    $param['Forma_Pagamento'] = Helpers::getPaymentType($param);
    $param['Local'] = Helpers::getPlace($param);
    $param['Status'] = Helpers::getStatusTJAM($param);
    $param['Status_Sint'] = Helpers::getStatusSINTJAM($param);
    return $param;
  }

}
