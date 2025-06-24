<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="guerindagg" />
    <title>StationFlow - Connexion</title>
    <link href="./assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="./assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet" />
    <link href="./assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('./assets/images/favicon/stationflow-favicon.svg')}}">
    <link rel="stylesheet" href="./assets/css/theme.min.css" />
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
        <div class="class py-6"></div>
        <section class="my-lg-14 my-8">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <img src="../assets/images/svg-graphics/signup-g.svg" alt="" class="img-fluid" />
                    </div>
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Bienvenue à StationFlow</h1>
                                                        
                            <p>Identifiez-vous pour accéder à votre tableau de bord.</p>
                        </div>
                        <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="formSignupEmail" class="form-label visually-hidden">Email
                                        address</label>
                                    <input type="email" class="form-control" id="formSignupEmail" name="email"
                                        placeholder="Email" required />
                                    <div class="invalid-feedback">Entrez votre email.</div>
                                </div>
                                <div class="col-12">
                                    <div class="password-field position-relative">
                                        <label for="formSignupPassword"
                                            class="form-label visually-hidden">Password</label>
                                        <div class="password-field position-relative">
                                            <input type="password" name="password" class="form-control fakePassword"
                                                id="formSignupPassword" placeholder="*********" required />
                                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                            <div class="invalid-feedback">Entrez votre mot de passe.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="remember"
                                            id="flexCheckDefault" />
                                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                    </div>
                                    <div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 d-grid"><button type="submit"
                                        class="btn btn-primary">Connexion</button>
                                </div>
                                <div>
                                    Pas de compte ?
                                    <a href="register.html">S'inscrire</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <!-- <script src="../assets/libs/jquery/dist/jquery.min.js"></script> -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

    <script src="../assets/js/theme.min.js"></script>

    <script src="../assets/js/vendors/password.js"></script>

    <script src="../assets/js/vendors/validation.js"></script>
</body>

</html>