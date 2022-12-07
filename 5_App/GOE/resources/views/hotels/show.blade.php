@extends('layouts.layout-bootstrap')
@section('content')
    <h1 class="display-5">{{ $hotel->name }} - {{ $hotel->address}}, {{ $hotel->city}} {{ $hotel->country }}</h1><br>
    <p class="display-6">Lista camere</p>
    <tbody>
                <!--Visualizza tutte le camere-->
                <table class="table table-striped">
                <tr>
                    <th>Numero</th>
                    <th>Capacità</th>
                    <th>Area fumatori</th>
                    <th>Wifi</th>
                    <th>Animali</th>
                    <th>Elimina</th>
                </tr>
                @foreach ($rooms as $room)
                    <tr>
                        <td class="col-3">{{$room->number}}</td>
                        <td class="col-3">{{$room->capacity}}</td>
                        <td class="col-1">{{$room->wifi}}</td>
                        <td class="col-1">{{$room->smoking_area}}</td>
                        <td class="col-1">{{$room->animals}}</td>
                        <td class="col-2">
                                <form method="POST" action="{{ route('rooms.destroy', ['room' => $room->number]) }}">
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