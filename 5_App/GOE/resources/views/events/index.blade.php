@extends('layouts.layout-bootstrap')

@section('content')

  <div class="row align-items-start">
    <div class="col-10">
        <p class="display-4">Eventi</p>
    </div>
    @if(Auth::user()->name_type == 'admin')
        <div class="col-md-12 text-right d-flex justify-content-end mb-3">
            <a class="btn btn-secondary mt-1" href="{{ route('hotels.index')}}">Vedi Hotel</a>
            <a class="btn btn-success mt-1 ms-1" href="{{ route('events.create')}}">Nuovo evento</a>
        </div>
    @endif
  </div>
            <tbody>
                @if(Auth::user()->name_type == 'admin')
                    <!--Visualizza tutti gli eventi-->
                    <table class="table table-striped">
                    @foreach ($events as $event)
                        <tr>
                            <td class="col-2">{{$event->name}}</td>
                            <td class="col-3">{{$event->date}}</td>
                            <td class="col-3">{{$event->id_hotel}}</td>
                            <td class="col-2">
                                <div >
                                    <a class="btn btn-info text-light" href="{{ route('events.show', ['event' => $event]) }}">Dettagli</a>
                                </div>
                            </td>
                            <td class="col-2">
                                <div >
                                    <a class="btn btn-secondary" href="{{ route('events.edit', ['event' => $event->id]) }}">Modifica</a>
                                </div>
                            </td>
                            <td class="col-2">
                                <form method="POST" action="{{ route('events.destroy', ['event' => $event->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input class="btn btn-danger text-light" type="submit" value="Elimina">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <!--Visualizza eventi utente-->
                    <table class="table table-striped">
                    @foreach ($events as $event)
                        <tr>
                            <td class="col-2">{{ $event->name }}</td>
                            <td class="col-3">{{$event->date}}</td>
                            <td class="col-3">{{$event->id_hotel}}</td>

                            <td class="col-2">
                                <div >
                                <a class="btn btn-info text-light" href="{{ route('events.show', ['event' => $event]) }}">Dettagli</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    @endif
@endsection