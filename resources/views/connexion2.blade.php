<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Codescandy" name="author" />
    <title>StationFlow</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/stationflow-favicon.svg" />

    <!-- Libs CSS -->
    <link href="./assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="./assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet" />
    <link href="./assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />

    <!-- Theme CSS -->
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
    <div class="border-bottom shadow-sm">
        <nav class="navbar navbar-light py-2">
            <div class="container justify-content-center justify-content-lg-between">
                <a class="navbar-brand" href="#">
                    <img src="./assets/images/logo/stationflow-logo.svg" alt="StationFlow Logo"
                        class="d-inline-block align-text-top" />
                </a>
                <span class="navbar-text">
                </span>
            </div>
        </nav>
    </div>

    <main>
        <section class="my-lg-14 my-8">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <img src="./assets/images/svg-graphics/signup-g.svg" alt="" class="img-fluid" />
                    </div>
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Se connecter </h1>
                            <p>Veuillez entrez vos identifiants ici</p>
                        </div>
                        <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row g-3">

                                <!-- Email Address -->
                                <div class="col-12">
                                    <label for="formSignupEmail" class="form-label ">Adresse email</label>
                                    <input type="email" id="email" class="form-control" name="email" placeholder="Email"
                                        required />
                                    <div class="invalid-feedback">Votre E-mail !</div>
                                </div>
                                <!-- Password -->
                                <div class="col-12">
                                    <div class="password-field position-relative">
                                        <label for="formSignupPassword" class="form-label ">Mot de passe</label>
                                        <div class="password-field position-relative">
                                            <input type="password" class="form-control fakePassword" id="password"
                                                name="password" required placeholder="********" />
                                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                            <div class="invalid-feedback">Votre mot de passe !</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="formSignuplname" class="form-label">Rôle</label>
                                    <select class="default-select form-control wide" name="role" id="role" required>
                                        <option value="gerant">Gérant</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                    <div class="invalid-feedback">Sélectionner un type de compte!</div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <!-- Remember Me -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="remember_me"
                                            name="remember" />
                                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                    </div>
                                    <div>
                                        Mot de passe oublié?
                                        @if (Route::has('password.request'))
                                            <a href={{route('password')}}>Resset it</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 d-grid"> <button type="submit"
                                        class="btn btn-primary">Connexion</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row g-4 py-4">
                <div class="border-top py-4">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center">
                            <span class="small text-muted">
                                copyright © 2025.Guérinda GOHOUE
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="./assets/js/theme.min.js"></script>
    <script src="./assets/js/vendors/password.js"></script>
    <script src="./assets/js/vendors/validation.js"></script>

</body>

</html>