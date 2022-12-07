@extends('layouts.layout-bootstrap')
@section('content')

<div class="container"><br>
<h1 class="display-3 text-center">Aggiungi un nuovo hotel</h1><br><br>

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <form method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input id="nome" type="text" class="form-control" name="nome" value="{{ old('nome') }}" required autocomplete="hotel" placeholder="Nome hotel" autofocus>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <input id="nazione" type="text" class="form-control" name="nazione" value="{{ old('nazione') }}" required autocomplete="nazione" placeholder="Nazione" autofocus>
                        </div>
                        <div class="col">
                            <input id="citta" type="text" class="form-control" name="citta" value="{{ old('citta') }}" required autocomplete="citta" placeholder="Città hotel" autofocus>
                        </div>
                    </div><br>
                    <div class="col">
                            <input id="indirizzo" type="text" class="form-control" name="indirizzo" value="{{ old('indirizzo') }}" required autocomplete="indirizzo" placeholder="Indirizzo hotel" autofocus>
                    </div><br><br><br>

                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Crea Hotel') }}
                    </button>
                    </div>
                </form>
          </div>
        </div>
      </div>
</div>
</div>
@endsection