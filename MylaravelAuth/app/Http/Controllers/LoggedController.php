<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Car;
use App\Brand;
use App\Pilot;

use App\Mail\NewCarNotify;

class LoggedController extends Controller
{
  public function __construct(){
    $this -> middleware('auth');
  }

  //create
  public function create(){
    $brands = Brand::all();

    $pilots = Pilot::all();
    return view('pages.create', compact('brands', 'pilots'));
  }


  public function storeCar(Request $request) {
    //dd($request -> all());
    $validate = $request -> validate([
      'name' => 'required|string|min:3',
      'model' => 'required|integer',
      'kw' => 'required|integer|min:10|max:3000',
    ]);

    $brand = Brand::findOrFail($request -> get('brand_id'));
    //dd($brand);
    $car = Car::make($validate);

    //Brand
    $car -> brand() -> associate($brand);
    $car -> save();         //per passarlo al database

    //Pilot
    $car -> pilots() -> attach($request -> get('pilot_id'));
    $car -> save();

    //mail
    $user = Auth::user();     //utente loggato
    Mail::to('test@mail.com')->send(new NewCarNotify($car));
    Mail::to($user -> email)->send(new NewCarNotify($car));

    //image
    $img = $request -> file('image');
    //dd($img);
    $imgExt = $img ->getClientOriginalExtension();
    //dd($img, $imgExt);
    $imgNewName = time() . rand(0, 1000) . '.' . $imgExt;
    //$imgNewName = time() . '_car-img.' . $imgExt;
    //dd($img, $imgExt, $imgNewName);
    $folder = '/car-img/';
    $imgFile = $img -> storeAs($folder, $imgNewName, 'public');
    //dd($img, $imgExt, $imgNewName, $imgFile);
    $car -> img= $imgNewName;
    $car -> save();                //per passarlo al database
    //dd($car);


    return redirect() -> route('homepage');
  }



  //Edit
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
    //dd($car);

    $car -> pilots() -> sync($request -> pilot_id);          //asfalta tutto attach(aggiunge)
    return redirect() -> route('homepage');
  }


  //Delete
  public function destroy($id) {
    //dd($id);
    $car = Car::findOrFail($id);
    //$car -> delete();

    $car -> deleted = true;
    $car -> save();
    return redirect() -> route('homepage');
  }
}
