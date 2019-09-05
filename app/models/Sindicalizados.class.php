<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sindicalizado extends Model
{
  public $timestamps = false;
  protected $table = 'Sindicalizado';
  protected $primaryKey = 'idSindicalizado';

  protected $fillable = [
    'idSindicalizado',
    'CEP',
    'Cidade',
    'Estado',
    'Logradouro',
    'Bairro',
    'Nome',
    'Matricula',
    'Data_Nascimento',
    'Status',
    'Status_Sint',
    'Categoria',
    'Forma_Pagamento',
    'Classe_idClasse',
    'Data_Cadastro',
    'Mae',
    'CPF',
    'RG',
    'Orgao',
    'Data_Expedicao',
    'Naturalidade',
    'Nacionalidade',
    'Pai',
    'Email',
    'Celular',
    'Telefone',
    'Data_Admissao',
    'Lotacao',
    'Local',
  ];
}
