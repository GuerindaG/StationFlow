<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>StationFlow - Gestion</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('./assets/images/favicon/stationflow-favicon.svg')}}">

    @include('Gerant.css')

    @include('Gerant.js')

</head>


<body>
    
    <div class="main-wrapper">

        @include('Gerant.navbar')

        <main class="main-content-wrapper">
            <section class="container">

                @yield('content-body')

            </section>

        </main>
    </div>

    @include('Gerant.js')

</body>

</html>