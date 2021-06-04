<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Brand;
use App\Pilot;

class TestController extends Controller
{
  public function homepage(){
    $cars = Car::all();
    return view('pages.homepage', compact('cars'));
  }

  public function edit($id) {
   $car = Car::findOrFail($id);

   $brands = Brand::all();
   $pilots = Pilot::all();
   return view('pages.edit', compact('car' , 'brands', 'pilots'));
 }

 public function update(Request $request, $id) {
    //dd($request -> all() ,  $id);
    $validate = $request -> validate([
      'name' => 'required|string|max:128',
      'model' => 'required|string|max:128',
      'kw' => 'required|integer',
    ]);
    $car = Car::findOrFail($id);
    //dd($validate, $car);

    $car -> update($validate);
    // dd($car);
    $car -> brand() -> associate($request -> brand_id);
    // dd($car);
    $car -> save();
    // dd($car);

    $car -> pilots() -> sync($request -> pilot_id);          //asfalta tutto attach(aggiunge)
    return redirect() -> route('homepage');
  }
}
