<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Reset password | {{ config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <!-- CoreUI CSS -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Custom Background Image CSS -->
    <style>
        body {
            background-image: url('./public/images/Background.jpg');
            /* Other background properties can be added here, such as background-size, background-repeat, etc. */
        }
    </style>
</head>

<body class="c-app flex-row align-items-center">
    <div class="container">
        <!-- ... Rest of the code ... -->
        <button type="submit" class="btn btn-block btn-primary btn-block btn-flat">
            <i class="bi-arrow-clockwise"></i> Reset
        </button>
    </div>

    <!-- CoreUI -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</body>

</html>