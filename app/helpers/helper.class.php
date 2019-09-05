<?php 

namespace App\Helpers;

class Helpers
{
  public function getPaymentType($input) {
    $payment = '';
    switch ($input['Forma_Pagamento']) {
      case 1:
        $payment = 'Desconto em Contracheque';
        break;
      case 2:
        $payment = 'Em Espécie';
        break;
        $payment = 'Outros';
        break;
    }

    return $payment;
  }

  public function getPlace($input) {
    $place = '';
    switch ($input['Local']) {
      case 1:
        $place = 'Capital';
        break;
      case 2:
        $place = 'Interior';
        break;
      case 3:
        $place = 'Outros';
        break;
      default:
        $place = 'Indefinido';
        break;
    }

    return $place;
  }
}
