@extends('layouts.layout-bootstrap')
@section('content')
    <p class="display-6">{{ $hotel->name }} - {{ $hotel->address}}, {{ $hotel->city}} {{ $hotel->country }}</p>
    <h1 class="display-3">{{ $event->name }} - {{ $event->date }}</h1><br>

    @if(Auth::user()->name_type == 'consigliere')
        <div class="col-md-12 text-right d-flex justify-content-end mb-3">
            <a class="btn btn-success mt-1 ms-1" href="{{ route('createGroup', $event) }}">Crea gruppo</a>
        </div>
    @endif
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="partecipanti-tab" data-bs-toggle="tab" data-bs-target="#partecipanti" type="button" role="tab" aria-controls="partecipanti-tab-pane" aria-selected="true">Partecipanti</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="gruppi-tab" data-bs-toggle="tab" data-bs-target="#gruppi" type="button" role="tab" aria-controls="gruppi-tab-pane" aria-selected="false">Gruppi</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="compagnie-tab" data-bs-toggle="tab" data-bs-target="#compagnie" type="button" role="tab" aria-controls="compagnie-tab-pane" aria-selected="false">Compagnie</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="camere-tab" data-bs-toggle="tab" data-bs-target="#camere" type="button" role="tab" aria-controls="camere-tab-pane" aria-selected="false">Camere</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="partecipanti" role="tabpanel" aria-labelledby="partecipanti" tabindex="0">
        
      <tbody>
        <table class="table table-striped">
          @foreach ($users as $user)
            <tr>
              <td class="col-5"><a href="{{ route('users.show', ['user' => $user->id]) }}" class="link-primary">{{ $user->email }}</a></td>
              <td class="col-3">{{$user->first_name}}</td>
              <td class="col-3">{{$user->last_name}}</td>
              <td class="col-1">{{$user->name_type}}</td>
            </tr>
          @endforeach
      </tbody>
      </table>
        
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <a class="page-link">Indietro</a>
            </li>
            <li class="page-item"><a class="page-link active" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#">Avanti</a>
            </li>
          </ul>
        </nav>
      </div>

      <div class="tab-pane fade" id="gruppi" role="tabpanel" aria-labelledby="gruppi" tabindex="0">
        <tbody>
          <table class="table table-striped">
            @foreach ($groups as $group)
              <tr>
                <td class="col-5"><a href="{{ route('groups.show', ['group' => $group->id]) }}" class="link-primary">{{ $group->name }}</a></td>
                <td class="col-3">{{$group->gender}}</td>
              </tr>
            @endforeach
        </tbody>
        </table>
      </div>

      <div class="tab-pane fade" id="compagnie" role="tabpanel" aria-labelledby="compagnie" tabindex="0">
        <tbody>
            <table class="table table-striped">
              @foreach ($companies as $company)
                <tr>
                  <td class="col-5"><a href="{{ route('companies.show', ['company' => $company->id]) }}" class="link-primary">{{ $company->name }}</a></td>
                  <td class="col-3">{{$company->id_group1}}</td>
                  <td class="col-3">{{$company->id_group2}}</td>
                </tr>
              @endforeach
          </tbody>
          </table>
      </div>

      <div class="tab-pane fade" id="camere" role="tabpanel" aria-labelledby="camere" tabindex="0">
        <tbody>
          <table class="table table-striped">
          <tr>
                    <th>Numero</th>
                    <th>Capacità</th>
                    <th>Area fumatori</th>
                    <th>Wifi</th>
                    <th>Animali</th>
                </tr>
            @foreach ($rooms as $room)
                <tr>
                  <td class="col-3">{{$room->number}}</td>
                  <td class="col-3">{{$room->capacity}}</td>
                  <td class="col-3">{{$room->smoking_area}}</td>
                  <td class="col-3">{{$room->wifi}}</td>
                  <td class="col-3">{{$room->animals}}</td>
                </tr>
            @endforeach
        </tbody>
        </table>
      </div>
    </div>  
@endsection