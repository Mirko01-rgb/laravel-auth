<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Car;
class Brand extends Model
{
  protected $fillable = [
    'name',
    'nationality',

  ];

  public function cars(){
    return $this -> hasMany(Car::class);
  }
}
