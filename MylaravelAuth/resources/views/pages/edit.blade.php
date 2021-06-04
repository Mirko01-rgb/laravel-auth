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
  <h1 class="text-center">Edit Car</h1>
  <form method="POST" action="{{route('update', $car-> id)}}">
    @csrf
    @method('POST')

    <div class="form-group row">
      <label for="name" class="col-md-3 col-form-label text-md-right">
        Name
      </label>
      <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ $car -> name }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="model" class="col-md-3 col-form-label text-md-right">
        Model
      </label>
      <div class="col-md-6">
        <input id="model" type="text" class="form-control" name="model" value="{{ $car -> model }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="kw" class="col-md-3 col-form-label text-md-right">
        Kw
      </label>
      <div class="col-md-6">
        <input id="kw" type="number" class="form-control" name="kw" value="{{ $car -> kw }}">
      </div>
    </div>

    <div class="form-group row">
      <label for="brand_id" class="col-md-3 col-form-label text-md-right">Brand</label>
      <div class="col-md-6">
        <select id='brand_id' class="form-control" name="brand_id" required>
          <option selected disabled></option>
          @foreach ($brands as $brand)
            <option value="{{$brand -> id}}"
              @if ($car -> brand -> id == $brand -> id)
                selected
              @endif
              >{{$brand -> name}} ({{$brand -> nationality}}) </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label for="pilot_id[]" class="col-md-3 col-form-label text-md-right">Pilot</label>
      <div class="col-md-6">
        <select id='pilot_id[]' class="form-control" name="pilot_id[]" required multiple>
          @foreach ($pilots as $pilot)
            <option value="{{$pilot -> id}}"
              @foreach ($car -> pilots as $carPilot)
                @if ($carPilot -> id == $pilot -> id)
                  selected
                @endif
              @endforeach
              >{{$pilot -> name}} {{$pilot -> lastname}}
            </option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-12 text-center">
        <button type="submit" class="btn btn-primary">
          Modifica
        </button>
      </div>
    </div>
  </form>

@endsection
