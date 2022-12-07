<!DOCTYPE html>
<html lang="en">
<head>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOE</title>
    <style>
        body{
            background-color: rgb(245, 245, 245);
        }
    </style>
</head>
<body>

<div class="container"><br><br><br><br><br>
<h1 class="display-3 text-center">Gestione Organizzazione eventi</h1><br><br>

<div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Login</h3>

            <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Mail" autofocus>
        </div><br>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror


        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
        </div><br>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <br><br>
        <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">
            {{ __('Login') }}
        </button>
        </div>
    </form>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <li>Nome utente o password non corretta</li>
        @endforeach
    @endif
          </div>
        </div>
      </div>
    </div>


    
    
</div>
</body>
</html>