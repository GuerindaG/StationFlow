<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="StationFlow - Gestion" name="author">
    <title></title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('./assets/images/favicon/stationflow-favicon.svg')}}">
    @include('Gerant.css')
    @include('Gerant.js')
</head>

<body>
    @include('Gerant.navbar')
    <div class="main-wrapper">
        @include('Gerant.verticalNav')
        <main class="main-content-wrapper">
            @yield('content-body')
        </main>
    </div>
</body>

</html>