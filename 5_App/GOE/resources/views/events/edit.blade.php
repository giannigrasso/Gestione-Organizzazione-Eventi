@extends('layouts.layout-bootstrap')
@section('content')
<form method="POST" action="{{route('events.update', ['event' => $event->id])}}">

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
    <label for="name">Nome Evento</label>
    <input type="text" class="form-control" name="name" placeholder="name" value="{{ old('title', $event->name) }}">
</div>

<div class="form-group">
      <label for="date">Data Evento</label>
      <input type="text" class="form-control" name="date" placeholder="date" value="{{ old('date', $event->date) }}">
</div><br><br>

<div class="form-group">
      <label for="hotel">Hotel Evento</label>
      <select class="form-select" aria-label="Seleziona hotel" name="hotel">
            <option selected>{{ old('hotel', $selectedHotel->name) }}</option>
            @foreach($hotels as $hotel)
                <option value="{{$hotel->name}}">{{$hotel->name }}</option>
            @endforeach
        </select>
</div><br>
<button type="submit" class="btn btn-success">Aggiorna Evento</button>

</form>

@endsection