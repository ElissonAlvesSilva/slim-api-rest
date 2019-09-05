<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dependentes extends Model
{
  public $timestamps = false;
  protected $table = 'Dependentes';
  protected $primaryKey = 'idDependente';

  protected $fillable = [
    'idDependentes',
    'Nome',
    'Data_Nascimento',
    'Sexo',
    'CPF',
    'RG',
    'Sindicalizado_idSindicalizado',
  ];
}
