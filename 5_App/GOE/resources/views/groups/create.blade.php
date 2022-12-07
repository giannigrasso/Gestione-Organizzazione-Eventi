@extends('layouts.layout-bootstrap')
@section('content')

<div class="container"><br>
<h1 class="display-3 text-center">Crea un nuovo gruppo</h1><br><br>

<form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
@csrf
<div class="form-group">
    <input id="gruppo" type="text" class="form-control" name="gruppo" value="{{ old('gruppo') }}" required autocomplete="gruppo" placeholder="Nome guppo" autofocus>
</div><br>  
<tbody>
    <table class="table table-striped">
        
        @for ($i = 0; $i < count($users); $i++)    
        <tr>
            <td class="col-3">{{$users[$i]->email}}</td>
            <td class="col-3">{{$users[$i]->first_name}}</td>
            <td class="col-3">{{$users[$i]->last_name}}</td>
            <td class="col-1">{{$users[$i]->name_type}}</td>
            <td>
                <input class="form-check-input me-1" id="{{$i}}" name="{{$i}}" type="checkbox">
            </td>
        </tr>
        @endfor
    </tbody>
    </table>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            {{ __('Crea Gruppo') }}
        </button>
    </div>
</form>
@endsection