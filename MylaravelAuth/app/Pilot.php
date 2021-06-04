<?php

namespace App;
use App\Car;
use Illuminate\Database\Eloquent\Model;

class Pilot extends Model
{
  public function cars(){
    return $this -> belongsToMany(Car::class);
  }
}
