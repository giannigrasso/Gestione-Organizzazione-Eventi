@extends('layouts.layout-bootstrap')
@section('content')
<form method="POST" action="{{route('hotels.update', ['hotel' => $hotel->id])}}">

@csrf
@method('PUT')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif 

<div class="form-group">
    <label for="name">Nome Hotel</label>
    <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('title', $hotel->name) }}">
</div><br>

<div class="form-group">
    <label for="name">Nazione</label>
    <input type="text" class="form-control" name="country" placeholder="country" value="{{ old('country', $hotel->country) }}">
</div><br>

<div class="form-group">
      <label for="date">Città Evento</label>
      <input type="text" class="form-control" name="city" placeholder="city" value="{{ old('city', $hotel->city) }}">
</div><br>

<div class="form-group">
    <label for="name">Indirizzo Evento</label>
    <input type="text" class="form-control" name="address" placeholder="address" value="{{ old('address', $hotel->address) }}">
</div><br><br>
<button type="submit" class="btn btn-success">Aggiorna Hotel</button>
</form>

<form method="POST" action="{{route('hotels.update', ['hotel' => $hotel->id])}}">
</form>

@endsection