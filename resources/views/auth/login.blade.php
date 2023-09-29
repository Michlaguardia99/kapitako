<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Login | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">

</head>

<body class="c-app flex-row align-items-center">

    <body style="background: url(../images/background3.jpg); background-size:cover;background-repeat:no-repeat">
        <div class="container">

            <div class="row mb-0">
                <div class="col-12 d-flex justify-content-center">
                    <img width="300px" src="{{ asset('images/logo-dark.png') }}" alt="Logo">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="{{ Route::has('register') ? 'col-md-8' : 'col-md-5' }}">
                    @if(Session::has('account_deactivated'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('account_deactivated') }}
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Please use your freshly created account to log in.',
                                showCloseButton: true,
                                showConfirmButton: false,
                                timer: 12000 // Auto close after 5 seconds
                            });
                        });
                    </script>
                    @endif
                    <div class="card-group">
                        <div class="card p-3 border-3 shadow-sm">
                            <div class="card-body">
                                <form method="post" action="{{ url('/login') }}">
                                    @csrf
                                    <div>
                                        <h1>
                                            <p class="text-light">Login
                                            <p>
                                            <h1>
                                                </p>
                                    </div>
                                    <p class="text-muted">Sign In to your account</p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bi bi-person"></i>
                                            </span>
                                        </div>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" maxlength="35">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock"></i>
                                            </span>
                                        </div>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" maxlength="8">
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <button class="btn btn-dark px-4" type="submit">Login</button>
                                        </div>
                                        <div class="col-8 text-right">
                                            <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                                Forgot password?
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @if(Route::has('register'))
                        <div class="card text-light bg-light py-4 " style="background-image: url('./images/try.png')">
                            <div class="card-body text-right">
                                <div>
                                    <h1>Sign up</h1>
                                    <p>Sign up to create your account</p>
                                    <a class="btn btn-lg btn-outline-light mt-4" href="{{ route('register') }}">Register Now!</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- CoreUI -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>

    </body>

</html>