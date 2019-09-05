<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anexo extends Model
{
  public $timestamps = false;
  protected $table = 'Anexo';
  protected $primaryKey = 'idAnexo';

  protected $fillable = [
    'idAnexo',
    'Foto',
    'Documento',
    'Sindicalizado_idSindicalizado',
  ];
}