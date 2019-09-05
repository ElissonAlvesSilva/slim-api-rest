<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pensionista extends Model
{
  public $timestamps = false;
  protected $table = 'Pencionista';
  protected $primaryKey = 'idPencionista';

  protected $fillable = [
    'idPencionista',
    'Nome',
    'Data_Nascimento',
    'CPF',
    'RG',
    'Data_Cadastro',
    'Sindicalizado_idSindicalizado',
  ];
}
