<!-- layout.blade.php or your main blade file -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
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


@if(auth()->check() && auth()->user()->hasVerifiedEmail())
<!-- Sidebar -->
<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show-dark {{ request()->routeIs('app.pos.*') ? 'c-sidebar-minimized' : '' }}" id="sidebar">
    <div class="c-sidebar-brand d-md-down-none bg-light">
        <a href="{{ route('home') }}">
            <img class="c-sidebar-brand-full" src="{{ asset('images/logo.png') }}" alt="Site Logo" width="200">
            <img class="c-sidebar-brand-minimized" src="{{ asset('images/logo.png') }}" alt="Site Logo" width="40">
        </a>
    </div>
    <ul class="c-sidebar-nav">
        <!-- Include the menu from 'layouts.menu' -->
        @include('layouts.menu')
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-coreui="navigation" data-class="c-sidebar-minimized"></button>
</div>
@endif

<!-- ... Rest of your HTML ... -->