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
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-glass row">
                <div class="dashboard_bar col-lg-12 text-end">
                    <h2>Tableau de bord JNP 050506</h2>
                </div>
            </nav>
        </div>
    </div>
    <div class="main-wrapper">

        @include('Gerant.navbar')

        <main class="main-content-wrapper">
            <section class="container">

                @include('Gerant.card')

                @yield('content-body')

            </section>

        </main>
    </div>

    @include('Gerant.js')

</body>

</html>