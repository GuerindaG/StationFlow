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
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <img src="../assets/images/svg-graphics/fp-g.svg" alt="" class="img-fluid" />
                    </div>
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1 d-flex align-items-center">
                        <div>
                            <div class="mb-lg-9 mb-5">
                                <h1 class="mb-2 h2 fw-bold">Mot de passe oublié?</h1>
                                <p>Please enter the email address associated with your account and We will email you a
                                    link to reset your password.</p>
                            </div>
                            <form class="needs-validation" novalidate method="POST" action="{{ route('password.email') }}" >
                                <!-- row -->
                                <div class="row g-3">
                                    <!-- col -->
                                    <div class="col-12">
                                        <!-- input -->
                                        <label for="formForgetEmail" class="form-label visually-hidden">Email</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Email" name="email" :value="old('email')" required autofocus  />
                                        <div class="invalid-feedback">Entrer un email valide !</div>
                                    </div>

                                    <!-- btn -->
                                    <div class="col-12 d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Renvoyer le mot de passe</button>
                                        <a href={{route('connexion')}} class="btn btn-light">Retour</a>
                                    </div>
                                </div>
                            </form>
                        </div>
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

    <!-- <script src="../assets/libs/jquery/dist/jquery.min.js"></script> -->
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
    <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/js/vendors/validation.js"></script>

</body>

</html>