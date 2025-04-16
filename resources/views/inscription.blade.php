<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>Gestionnaire de station service</title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">
    <!-- Libs CSS -->
    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-M8S4MT3EYG");
    </script>
    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] =
                c[a] ||
                function () {
                    (c[a].q = c[a].q || []).push(arguments);
                };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "kuc8w5o9nt");
    </script>

</head>

<body>
    <!-- navigation -->
    <div class="border-bottom shadow-sm">
        <nav class="navbar navbar-light py-2">
            <div class="container justify-content-center justify-content-lg-between">
                <a class="navbar-brand" href="../index.html">
                    <img src="../assets/images/logo/freshcart-logo.svg" alt="" class="d-inline-block align-text-top">
                </a>
                <span class="navbar-text">
                    Vous avez déjà un compte? <a href={{ route('connexion') }}>Se connecter</a>
                </span>
            </div>
        </nav>
    </div>
    <main>
        <section class="my-lg-14 my-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <!-- img -->
                        <img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid" />
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Inscrivez-vous</h1>
                            <p>Bienvenue dans votre gestionnaire! Entrez votre email pour commencer.</p>
                        </div>
                        <!-- form -->
                        <form class="needs-validation" novalidate  method="POST" action="{{ route('register') }}">
                            <div class="row g-3">
                                <!-- col -->
                                <div class="col">
                                    <!-- input -->
                                    <label for="formSignupfname" class="form-label visually-hidden">First Name</label>
                                    <input type="text" class="form-control" id="formSignupfname"
                                        placeholder="First Name" required />
                                    <div class="invalid-feedback">Please enter first name.</div>
                                </div>
                                <div class="col">
                                    <!-- input -->
                                    <label for="formSignuplname" class="form-label visually-hidden">Last Name</label>
                                    <input type="text" class="form-control" id="formSignuplname"
                                        placeholder="First Name" required />
                                    <div class="invalid-feedback">Please enter last name.</div>
                                </div>
                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formSignupEmail" class="form-label visually-hidden">Email
                                        address</label>
                                    <input type="email" class="form-control" id="formSignupEmail" placeholder="Email"
                                        required />
                                    <div class="invalid-feedback">Please enter email.</div>
                                </div>
                                <div class="col-12">
                                    <div class="password-field position-relative">
                                        <label for="formSignupPassword"
                                            class="form-label visually-hidden">Password</label>
                                        <div class="password-field position-relative">
                                            <input type="password" class="form-control fakePassword"
                                                id="formSignupPassword" placeholder="*****" required />
                                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                            <div class="invalid-feedback">Please enter password.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- btn -->
                                <div class="col-12 d-grid"><button type="submit"
                                        class="btn btn-primary">S'inscrire</button></div>

                                <!-- text -->
                                <p>
                                    <small>
                                        By continuing, you agree to our
                                        <a href="#!">Terms of Service</a>
                                        &
                                        <a href="#!">Privacy Policy</a>
                                    </small>
                                </p>
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
                        <div class="col-md-6">
                            <span class="small text-muted">
                                copyright © 2025
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>

    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/js/vendors/password.js"></script>
    <script src="../assets/js/vendors/validation.js"></script>

</body>

</html>