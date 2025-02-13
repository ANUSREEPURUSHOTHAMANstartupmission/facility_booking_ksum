<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{Config::get('app.name')}}</title>
    <!-- CSS files -->


     
    <link href={{ asset("/css/tabler.css") }} rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('style')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Datepicker -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>



  </head>
  <body class="antialiased">
    <x-flash-message></x-flash-message>

    @yield('content')

    <script src={{ asset("/js/tabler.js") }}></script>
    
    @yield('script')

    <script>
    $(document).ready(function () {
        $('.yearpicker').datepicker({
            format: "yyyy", // Only year
            viewMode: "years", // Show only years
            minViewMode: "years", // Disable months and days selection
            autoclose: true
        });
    });
</script>
  </body>

</html>