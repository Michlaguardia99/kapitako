<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') {{ config('app.name') }}</title>
    <meta content="KAPI TAKO" name="author">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    @include('includes.main-css')
</head>

<body class="c-app">
    @include('layouts.sidebar')
    <div class="c-wrapper">
        <header class="c-header c-header-light c-header-fixed">
            @include('layouts.header')
            <div class="c-subheader justify-content-between px-3">
                @yield('breadcrumb')
            </div>
        </header>

        <div class="c-body">
            <main class="c-main">
                @yield('content')
            </main>
        </div>

        @include('layouts.footer')
    </div>
    <!-- layout.blade.php or your main blade file -->
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <!-- SweetAlert script -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @if(Session::has('success') && !auth()->user()->userAlerts->contains('user_id', auth()->id()))
    <!-- SweetAlert to display the success message -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ Session::get('success') }}",
            }).then(() => {
                // Save the user alert in the database to indicate that it has been shown to the current user
                fetch("{{ route('user.alerts.store') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    },
                    body: JSON.stringify({}),
                });
            });
        });
    </script>
    @endif

    @include('includes.main-js')
</body>


</html>