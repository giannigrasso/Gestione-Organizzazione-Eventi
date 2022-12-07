@extends('layouts.layout-bootstrap')

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

  <div class="row align-items-start">
    <div class="col-10">
        <p class="display-4">Hotel</p>
    </div>

    <div class="col-md-12 text-right d-flex justify-content-end mb-3">
            <a class="btn btn-secondary mt-1" href="{{ route('events.index')}}">Vedi Eventi</a>
            <a class="btn btn-success mt-1 ms-1" href="{{ route('hotels.create')}}">Nuovo Hotel</a>
            <a class="btn btn-info mt-1 ms-1" href="{{ route('rooms.create') }}">Nuova camera</a>
        </div>
  </div>
        <tbody>
                <!--Visualizza tutti gli eventi-->
                <table class="table table-striped">
                @foreach ($hotels as $hotel)
                    <tr>
                        <td class="col-2">{{$hotel->name}}</td>
                        <td class="col-3">{{$hotel->address}}</td>
                        <td class="col-3">{{$hotel->city}}</td>
                            <td class="col-2">
                                <div >
                                    <a class="btn btn-info text-light" href="{{ route('hotels.show', ['hotel' => $hotel]) }}">Dettagli</a>
                                </div>
                            </td>
                            <td class="col-2">
                                <div >
                                    <a class="btn btn-secondary" href="{{ route('hotels.edit', ['hotel' => $hotel->id]) }}">Modifica</a>
                                </div>
                            </td>
                            <td class="col-2">
                                <form method="POST" action="{{ route('hotels.destroy', ['hotel' => $hotel->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger text-light" type="submit" value="Elimina">
                                </form>
                            </td>

                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection