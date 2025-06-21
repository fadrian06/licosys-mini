<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <base href="{{ str_replace('index.php', '', $_SERVER['SCRIPT_NAME']) }}" />
    <link rel="icon" href="./favicon.png" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center pt-md-5 text-bg-light">
      <a href="./">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
      </a>

      <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
      </div>
    </div>
  </body>
</html>
