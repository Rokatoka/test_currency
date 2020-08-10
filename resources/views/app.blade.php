<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="client-secret" content="7EMAoa2QcblQbKip9DNZEhaZIJtCslXn0Aepct13">

    <title>Test currency</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div v-if="user">
            <navbar></navbar>
            <router-view></router-view>
        </div>
        <div v-else>
            <login></login>
        </div>
    </div>
</body>
</html>
