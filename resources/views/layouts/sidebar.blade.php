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