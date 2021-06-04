<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class TestController extends Controller
{
  public function homepage(){
    $cars = Car::all();
    return view('pages.homepage', compact('cars'));
  }
}
