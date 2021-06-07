<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Brand;
use App\Pilot;

class TestController extends Controller
{
  public function homepage(){
    //$cars = Car::all();
    $cars = Car::where('deleted', false) -> get();
    return view('pages.homepage', compact('cars'));
  }


}
