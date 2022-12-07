@extends('layouts.layout-bootstrap')
@section('content')

<div class="container"><br>
<h1 class="display-3 text-center">Aggiungi una nuova camera</h1>
<br><br>

<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <form method="POST" action="{{ route('rooms.store') }}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="hotel">Hotel</label>
                        <select class="form-select" aria-label="Seleziona hotel" name="hotel">
                                @foreach($hotels as $hotel)
                                    <option value="{{$hotel->name}}">{{$hotel->name }}</option>
                                @endforeach
                            </select>
                    </div><br>

                    @csrf
                    <div class="form-group">
                        <input id="number" type="number" class="form-control" name="number" value="{{ old('number') }}" required autocomplete="number" placeholder="Numero camera" autofocus>
                    </div><br>
                    <div class="row">
                        <div class="col">
                            <input id="capacity" type="capacity" class="form-control" name="capacity" value="{{ old('capacity') }}" required autocomplete="capacity" placeholder="Posti letto" autofocus>
                        </div>
                    </div><br>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="wifi" id="wifi" name="wifi">
                        <label class="form-check-label" for="wifi">
                            Wi-fi
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="smokingArea" id="smokingArea" name="smokingArea">
                        <label class="form-check-label" for="smokingArea">
                            Area fumatori
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="animals" id="animals" name="animals">
                        <label class="form-check-label" for="animals">
                            Animali
                        </label>
                    </div><br><br>

                    <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Crea camera') }}
                    </button>
                    </div>
                </form>
          </div>
        </div>
      </div>
</div>
</div>
@endsection