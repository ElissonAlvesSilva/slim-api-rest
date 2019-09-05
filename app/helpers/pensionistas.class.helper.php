<?php 

namespace App\Helpers;

use App\Models\Pensionista;

class PensionistaHelper {
  public function getPensionista($id)
  {
    try {
      $pensionista = Pensionista::where('Sindicalizado_idSindicalizado', $id)->first();
      return $pensionista;
    } catch (ModelNotFoundException $e) {
      throw new Exception('Not found class');
    }
  }

  public function makePensionista($input, $id)
  {
    $input['Pensionista']['Sindicalizado_idSindicalizado'] = $id;
    $pensionista = Pensionista::create($input['Pensionista']);
    return $pensionista;
  }

  public function updatePensionista($input, $id) {
    Pensionista::where('Sindicalizado_idSindicalizado', $id)
                                ->update($input['Pensionista']);
    return $input['Pensionista'];
  }
}