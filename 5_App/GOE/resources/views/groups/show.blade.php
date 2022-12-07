@extends('layouts.layout-bootstrap')
@section('content')
    <h1>{{ $group->name }}</h1>
    <tbody>
                <!--Visualizza tutte le camere-->
                <table class="table table-striped">
                @foreach ($users as $user)
                    <tr>
                        <td class="col-3">{{$user->email}}</td>
                        <td class="col-3">{{$user->first_name}}</td>
                        <td class="col-1">{{$user->last_name}}</td>
                        <td class="col-1">{{$user->name_type}}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection