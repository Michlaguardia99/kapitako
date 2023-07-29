@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-top: 2%">
            <div class="card" style="width: 40rem;">
                <div class="card-body-auth" style="text-align: center; padding:30px;">
                    <h4 class="card-title">Verify Your Email Address</h4>
                    @if (session('resent'))
                    <p class="alert alert-success" role="alert">A fresh verification link has been sent to
                        your email address</p>
                    @endif
                    <p class="card-text">Before proceeding, Please check your email for a verification link to access the contents.<br>If you did not receive the email,</p>
             

                    <!-- Your button and form -->
                    <button style="padding: 10px; border-radius: 20px; border: none; background: #131420; color: white;">
                        <a style="cursor:pointer; text-decoration: none; color: white;" onclick="event.preventDefault(); document.getElementById('email-form').submit();">
                            {{ __('Click here to request another') }}
                        </a>
                    </button>
                    <form id="email-form" action="{{ route('verification.resend') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection