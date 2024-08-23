<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Incluye Bootstrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <!-- Encabezado con el logo -->
        <div class="row mt-4">
            <div class="col-md-2 col-sm-4">
                <img src="{{ asset('') }}" alt="" class="img-fluid">
            </div>
        </div>

        <!-- Formulario de login centrado -->
        <div class="row justify-content-center align-items-center" style="height: 60vh;">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(Session::has('error-message'))
                        <p class="alert alert-info">{{ Session::get('error-message') }}</p>
                        @endif
                        @if(Session::has('success-message'))
                        <p class="alert alert-success">{{ Session::get('success-message') }}</p>
                        @endif

                        <form action="{{ route('cliente.login.functionality') }}" method="post">
                            @csrf
                            <div class="form-group row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            Recuérdame
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
