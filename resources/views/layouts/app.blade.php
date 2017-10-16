<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" type="image/x-icon" href="/assets/img/fav.png" />

    <title>{{ config('app.name', 'Task') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

</head>
    <body class="{{Route::currentRouteName()}}">
        <div id="app">
            <div id="app-canvas" class="app-canvas">
                @yield('content')
            </div>
        </div>
    </body>
</html>
