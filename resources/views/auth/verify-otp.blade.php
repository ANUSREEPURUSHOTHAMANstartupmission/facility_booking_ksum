@extends('layouts.main')

@section('content')
<div class=" d-flex flex justify-content-center py-4 ">
    <div class="row justify-content-center pt-5">
        <div class="text-center mb-4">
        <a href="."><img src={{asset("./img/logo.svg")}} height="100" alt=""></a>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <h4 class="card-title text-center">Verify OTP</h4>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" autocomplete="off" action="{{ route('verify-otp') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP</label>
                            <input type="text" name="otp" class="form-control text-center" maxlength="6" pattern="\d{6}" required placeholder="Enter 6-digit OTP">

                            @error('otp') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@if(auth()->check())
    <script>
        history.pushState(null, null, location.href);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, location.href);
        });
    </script>
@endif
