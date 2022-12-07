@extends('layouts.layout-bootstrap')
@section('content')

<h1>{{ $user->email }}</h1>
@if(auth()->user()->email == $user->email)
    <form method="POST" action="{{route('users.update', ['user' => $user->id])}}">
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
        <label for="first_name">Nome</label>
        <input type="text" class="form-control" name="first_name" placeholder="Nome" value="{{ old('first_name', $user->first_name) }}">
    </div>

    <div class="form-group">
        <label for="last_name">Cognome</label>
        <input type="text" class="form-control" name="last_name" placeholder="Cognome" value="{{ old('last_name', $user->last_name) }}">
    </div><br><br>

    <div class="form-group">
        <label for="old">Modifica password</label>
        <input type="password" class="form-control" name="old" placeholder="Inserisci password attuale"><br><br>
        <input type="password" class="form-control" name="new" placeholder="Inserisci nuova password"><br>
        <input type="password" class="form-control" name="confirm" placeholder="Conferma nuova password">
    </div><br>

    <div id="liveAlertPlaceholder"></div>      
    <button type="submit" class="btn btn-success" id="liveAlertBtn">Modifica</button>

    </form>
@else
    <ul class="list-group">
        <li class="list-group-item">ID: {{$user->id}}</li>
        <li class="list-group-item">Nome: {{$user->first_name}}</li>
        <li class="list-group-item">Cognome: {{$user->last_name}}</li>
        <li class="list-group-item">Data di nascita: {{$user->birth_date}}</li>
        @if($user->gender)
            <li class="list-group-item">Sesso: Maschio</li>
        @else
            <li class="list-group-item">Sesso: Femmina</li>
        @endif
        </li>
    </ul>
@endif

@endsection