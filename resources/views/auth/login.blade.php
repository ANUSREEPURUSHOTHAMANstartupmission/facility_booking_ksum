@extends('layouts.main')

@section('content')

<!-- <div class="flex-fill d-flex flex-column justify-content-center py-4 h-100" style="min-height: 100vh">
  <div class="container-tight py-6">
    <div class="text-center mb-4">
      <a href="."><img src={{asset("./img/logo.svg")}} height="100" alt=""></a>
    </div>
    <form class="card card-md" action="{{route('login')}}" method="post" autocomplete="off">
      @csrf
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Login to your account</h2>
        <x-input-field label="Email Address" type="email" name="email" placeholder="Enter email"></x-input-field>
        <div class="form-footer">
          <button type="submit" class="btn btn-primary w-100">Sign in</button>
        </div>
      </div>
    </form>
    {{-- <div class="text-center text-muted mt-3">
      Don't have account yet? <a href="{{route('register')}}" tabindex="-1">Sign up</a>
    </div> --}}

  </div>
</div> -->

<div class="flex-fill d-flex flex-column justify-content-center py-4 h-100" style="min-height: 100vh">
    <div class="row justify-content-center">
        <div class="text-center mb-4">
        <a href="."><img src={{asset("./img/logo.svg")}} height="100" alt=""></a>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    
                    <h4 class="card-title text-center">Login to your account</h4>

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                        <x-input-field label="Email Address" type="email" name="email" placeholder="Enter email"></x-input-field>

                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign in</button>
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

