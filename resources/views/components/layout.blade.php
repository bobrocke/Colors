<!DOCTYPE html>
<html>
  <head>
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <link rel="icon" href="/icon.png" type="image/png">
    <link rel="icon" href="/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/icon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{Vite::asset('resources/css/custom.css')}}">

    @vite(["resources/js/app.js", "resources/css/custom.css"])
  </head>

  <body>
    <nav class="navbar navbar-expand-lg bg-primary pt-3">
      <div class="container-fluid ms-3">
        <a class="navbar-brand" href="{{route("home")}}">
          <img src="{{Vite::asset('resources/images/Logo.svg')}}">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="navbar-nav me-auto mb-2 mb-lg-0 fs-4 fw-medium">
            <a class="nav-link" href="{{route("home")}}">Home</a>
            <a class="nav-link" href="{{route("about")}}">About</a>
              <div class=" nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route("colors")}}">Color Range</a>
                <a class="dropdown-item" href="{{route("about")}}">About</a>
                <hr class="dropdown-divider">
                <a class="dropdown-item" href="{{route("home")}}">Home</a>
              </div>
          </div>
        </div>
      </div>
      Laravel
    </nav>

    {{ $slot }}

  </body>
</html>
