<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pilot;
use Faker\Generator as Faker;

$factory->define(Pilot::class, function (Faker $faker) {
    return [
      'name' => $faker -> firstname,
      'lastname' => $faker -> lastname,
      'nationality' => $faker -> state,
      'date_of_birth' => $faker -> date,
    ];
});
