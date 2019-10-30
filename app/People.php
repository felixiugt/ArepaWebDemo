<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
  public $timestamps = false;
  protected $table = 'people';
  protected $fillable = [
    'id',
    'nombre',
    'correo',
    'cedula',
    'cargo',
];
}
