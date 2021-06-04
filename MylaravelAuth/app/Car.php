<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Pilot;
class Car extends Model
{
  protected $fillable = [
    'name',
    'model',
    'kw',
    'brand_id'
  ];

  //one to many
  public function brand(){
    return $this -> belongsTo(Brand::class);
  }

  //many to belongsToMany
  public function pilots(){
    return $this -> belongsToMany(Pilot::class);
  }
}
