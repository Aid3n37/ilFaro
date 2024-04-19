<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="container mt-5 pt-5">
        
      <div class="alert alert-danger text-center" role="alert">
        <h2 class="display-3">@yield('code')</h2>
        <p class="display-5"> @yield('message')</p>
      </div>
    </div>
  </body>
</html>