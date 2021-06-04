<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
  return [
    'name' => $faker -> firstname,
    'model' => $faker ->  numberBetween( 10000, 99999),
    'kw' => $faker -> numberBetween( 125, 1000),
  ];
});
