<?php 

namespace App\Helpers;

use App\Models\Dependentes;

class DependentesHelper {
  public function getDependentes($id)  {
    try {
      $dependentes = Dependentes::where('Sindicalizado_idSindicalizado', $id)->get();
      return $dependentes;
    } catch (ModelNotFoundException $e) {
      throw new Exception('Not found class');
    }
  }

  public function makeDependentes($input, $id)  {
    $dependentes = $input['Dependentes'];
    
    $dep = [];
    foreach ($dependentes as $value) {
      $value['Sindicalizado_idSindicalizado'] = $id;
      array_push($dep, $value);
      Dependentes::create($value);
    }
    return $dep;
  }

  public function updateDependentes($input, $id)  {
    $dependentes = $input['Dependentes'];
    
    $dep = [];
    foreach ($dependentes as $value) {
      array_push($dep, $value);
      Dependentes::where('idDependentes', $value['idDependentes'])->update($value);
    }
    return $dep;
  }
}