@extends('layouts.layout-bootstrap')
@section('content')

<div class="container"><br>
<h1 class="display-3 text-center">Aggiungi un nuovo evento</h1><br><br>

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

                <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input id="evento" type="text" class="form-control" name="evento" value="{{ old('evento') }}" required autocomplete="evento" placeholder="Nome evento" autofocus>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <input id="partecipanti" type="number" min="0" class="form-control" name="partecipanti" value="{{ old('partecipanti') }}" required autocomplete="partecipanti" placeholder="MAX partecipanti" autofocus>
                        </div>
                        <div class="col">
                            <input id="data" type="date" class="form-control" name="data" value="{{ old('data') }}" required autocomplete="data" placeholder="Data evento" autofocus>
                        </div>
                    </div><br>


                    <div class="form-group">
                        <label for="hotel">Hotel Evento</label>
                        <select class="form-select" aria-label="Seleziona hotel" name="hotel">
                                @foreach($hotels as $hotel)
                                    <option value="{{$hotel->name}}">{{$hotel->name }}</option>
                                @endforeach
                            </select>
                    </div><br><br>


                    <div class="mb-3">
                        <label for="formFile" class="form-label">Inserisci csv</label>
                        <input class="form-control" type="file" id="formFile" name="formFile">
                    </div>
                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Crea Evento') }}
                    </button>
                    </div>
                </form>
          </div>
        </div>
      </div>
</div>
</div>
@endsection