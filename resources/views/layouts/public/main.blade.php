<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{Config::get('app.name')}}</title>
    <!-- CSS files -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <link href={{ asset("/css/main.css") }} rel="stylesheet"/>
    <link href={{ asset("/css/navbar.css") }} rel="stylesheet"/>
    @yield('style')
  </head>
  <body>
    @include('layouts.public.aside')

    @yield('content')

    <footer>
      <div id="ksum-copy">
        <div class="container">
          <h6 class=" text-start">For assistance contact</h6>
          <div class="row text-center mt-4">

            <div class="col-md-4">
             <div class="d-flex gap-4">
              <p class="mb-1">Trivandrum - </p>
              <p>Manu S</p>
              <a href="tel:04712700270" class="link-light">0471-2700270</a>
             </div>
            </div>

            <div class="col-md-4">
             <div class="d-flex gap-4">
              <p class="mb-1">Kochi - </p>
              <p>Shajahan Ibrahim</p>
              <a href="tel:04842977137" class="link-light">0484-2977137</a>
             </div>
            </div>

            <div class="col-md-4">
             <div class="d-flex gap-4">
              <p class="mb-1">Calicut - </p>
              <p>Ramees Ashraf</p>
              <a href="tel:9633033339" class="link-light">9633033339</a>
             </div>
            </div>
          </div>
          <div class="d-flex justify-content-between pt-5">
            <div>Copyright &copy; {{date('Y')}} All Rights Reserved.</div>
            <div class="text-right">
              {{-- <a href="https://business.startupmission.in/disclaimer" target="_blank">Disclaimer</a><span class="mx-2">|</span>
              <a href="https://business.startupmission.in/privacy" target="_blank">Privacy Policy</a><span class="mx-2">|</span>
              <a href="https://business.startupmission.in/termsofuse" target="_blank">Terms of Use</a><span class="mx-2">|</span> --}}
              <span>Powered by </span><a href="https://startupmission.kerala.gov.in" target="_blank">Kerala Startup Mission &#xae;</a></div>
          </div>
        </div>
      </div>
    </footer>





    <script src={{ asset("/js/main.js") }}></script>
    
    @yield('script')
  </body>
</html>