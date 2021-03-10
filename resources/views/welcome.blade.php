<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Laravel</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
  <link href="//transloadit.edgly.net/releases/uppy/robodog/v1.6.7/robodog.min.css" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script src="https://unpkg.com/@diracleo/vue-enlargeable-image/dist/vue-enlargeable-image.min.js"></script>

</head>
<body>
  <div id="app">
    <div class="body">
      <app ref="app"></app>
    </div>
  </div>
  <script src="{{ mix('/js/app.js') }}"></script>
  <script src="//transloadit.edgly.net/releases/uppy/robodog/v1.6.7/robodog.min.js"></script>
</body>
</html>
