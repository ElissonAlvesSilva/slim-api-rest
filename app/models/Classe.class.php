<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
  public $timestamps = false;
  protected $table = 'Classe';
  protected $primaryKey = 'idClasse';

  protected $fillable = [
    'idClasse',
    'Descricao',
  ];
}
