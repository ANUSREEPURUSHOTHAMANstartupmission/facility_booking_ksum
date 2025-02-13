@extends('layouts.main')

@section('content')
<div class="flex-fill d-flex flex-column justify-content-center py-4 h-100" style="min-height: 100vh">
    <div class="row justify-content-center">
        <div class="text-center mb-4">
            <a href="."><img src="{{ asset('./img/logo.svg') }}" height="100" alt="Logo"></a>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <!-- @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif -->

                    @if(!session('success'))
                        <!-- User ID Entry Form -->
                        <form method="POST" autocomplete="off" action="{{ route('uidlink') }}">
                            @csrf
                            <div class="mb-3">
                                <x-input-field label="User ID" type="text" name="user_id" placeholder="Enter your UID" autocomplete="false"></x-input-field>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Next</button>
                        </form>
                    @endif

                    @if(session('success'))
                        <form method="POST" autocomplete="off" action="{{ route('verify-otpuid') }}">
                            @csrf
                            <p class="text-muted text-center">OTP sent to <strong>{{ session('uid_email') }}</strong></p>

                            <input type="hidden" name="redirect_url" value="{{ session('previous_url') }}">

                            <div class="mb-3">
                                <label for="otp" class="form-label">Enter OTP</label>
                                <input type="text" name="otp" class="form-control text-center" maxlength="6" pattern="\d{6}" required placeholder="Enter 6-digit OTP">
                            </div>

                            <button type="submit" class="btn btn-success w-100">Verify</button>
                        </form>

                       
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
