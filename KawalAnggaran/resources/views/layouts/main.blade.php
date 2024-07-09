<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kawal Anggaran | {{ $title }}</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/regstyle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tablecarousel.css') }}" rel="stylesheet">
    <script src="{{ asset('js/slider.js') }}" defer></script>
    <script src="{{ asset('js/chart.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  </head>

  <body>
    @include("partials.navbar")
    <div>
      <div class="bg">
        <div class="content">
          @yield("container")
        </div>
      </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>

  @include("partials.footer")
  
</html>