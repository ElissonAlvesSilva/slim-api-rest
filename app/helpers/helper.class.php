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

  public function getCategory($input)
  {
    $category = '';
    switch ($input['Categoria']) {
      case 1:
        $category = 'Servidor';
        break;
      case 2:
        $category = 'Serventuário';
        break;
      case 3:
        $category = 'Magistrado';
        break;
      case 5:
        $category = 'Extra Judicial';
        break;
      default:
        $category = 'Outros';
        break;
    }

    return $category;
  }

  public function getStatusTJAM($input) {
    $payment = '';
    switch ($input['Status']) {
      case 1:
        $payment = 'Ativo';
        break;
      case 2:
        $payment = 'Aposentado';
        break;
      case 3:
        $payment = 'Pensionista';
        break;
    }

    return $payment;
  }

  public function getStatusSINTJAM($input) {
    $payment = '';
    switch ($input['Status_Sint']) {
      case 1:
        $payment = 'Ativo';
        break;
      case 2:
        $payment = 'Inativo';
        break;
    }

    return $payment;
  }
}
