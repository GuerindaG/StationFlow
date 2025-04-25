<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Codescandy" name="author" />
    <title>StationFlow - 404-error</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="" href="{{ asset('./assets/images/favicon/stationflow-favicon.svg')}}" />

    <!-- Libs CSS -->
    <link href="{{ asset('./assets/libs/bootstrap-icons/font/bootstrap-icons.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('./assets/libs/feather-webfont/dist/feather-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('./assets/libs/simplebar/dist/simplebar.min.css')}}" rel="stylesheet" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/css/theme.min.css')}}" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-M8S4MT3EYG");
    </script>
</head>

<body>
    <main>
        <section>
            <div class="container d-flex flex-column">
                <div class="row min-vh-100 justify-content-center align-items-center">
                    <div class="offset-lg-1 col-lg-10 py-8 py-xl-0">
                        <div class="mb-10 mb-xxl-0">
                            <a href="#"><img src="{{ asset('../assets/images/logo/stationflow-logo.svg')}}" alt="" /></a>
                        </div>
                        <div class="row justify-content-center align-items-center">
                            <div class="col-md-6">
                                <div class="mb-6 mb-lg-0">
                                    <h1>Oops ! Page non trouvée.</h1>
                                    <p class="mb-8">
                                        La page que vous recherchez n'existe pas ou a été déplacée.
                                    </p>
                                    <a href="#" class="btn btn-dark">
                                        Retour
                                        <i class="feather-icon icon-arrow-right"></i>
                                    </a>
                                    <a href="{{ route('connexion') }}" class="btn btn-primary ms-2">Retour à
                                        l'accueil</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <img src="{{ asset('../assets/images/svg-graphics/error.svg')}}" alt="" class="img-fluid" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src=".{{ asset('./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src=".{{ asset('./assets/libs/simplebar/dist/simplebar.min.js')}}"></script>

    <script src=".{{ asset('./assets/js/theme.min.js')}}"></script>

</body>

</html>