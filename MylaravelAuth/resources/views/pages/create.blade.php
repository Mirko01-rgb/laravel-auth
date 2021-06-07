@extends('layouts.main-layout')
@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <h1 class="text-center">New Car:</h1>
  <form method="POST" action="{{route('store')}}"  enctype="multipart/form-data" >
    @csrf
    @method('POST')
    <div class="form-group row">
      <label for="name" class="col-md-3 col-form-label text-md-right">
        Name
      </label>
      <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="model" class="col-md-3 col-form-label text-md-right">
        Model
      </label>
      <div class="col-md-6">
        <input id="model" type="number" class="form-control" name="model" required>
      </div>
    </div>

    <div class="form-group row">
      <label for="kw" class="col-md-3 col-form-label text-md-right">
        Kw
      </label>
      <div class="col-md-6">
        <input id="kw" type="number" class="form-control" name="kw" required >
      </div>
    </div>

    <div class="form-group row">
      <label for="brand_id" class="col-md-3 col-form-label text-md-right">
        Brand
      </label>
      <div class="col-md-6">
        <select id="brand_id" class="form-control" name="brand_id" required>
          <option selected disabled> Brand</option>
          @foreach ($brands as $brand)
            <option value="{{$brand -> id}}">
              {{$brand -> name}}
              ({{$brand -> nationality}})
            </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="pilot_id[]" class="col-md-3 col-form-label text-md-right">
        Pilot
      </label>
      <div class="col-md-6">
        <select id="pilot_id[]" class="form-control" name="pilot_id[]" required multiple>
          @foreach ($pilots as $pilot)
            <option value="{{$pilot-> id}}">
              {{$pilot -> name}}
              {{$pilot -> lastname}}
              ({{$pilot -> nationality}})
            </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="image" class="col-md-3 col-form-label text-md-right">
        Image
      </label>
      <div class="col-md-6">
        <input id="image" type="file" class="form-control" name="image" required>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary">
          Create
        </button>
      </div>
    </div>
  </form>

@endsection
