<!DOCTYPE html>
<html lang="en">

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
    <div class="class py-6"></div>
    <main>
        <section class="my-lg-14 my-8">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <img src="../assets/images/svg-graphics/signin-g.svg" alt="" class="img-fluid" />
                    </div>
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1 d-flex align-items-center">
                        <div>
                            <div class="mb-lg-9 mb-5">
                                <h1 class="mb-2 h2 fw-bold">Changer votre mot de passe ?</h1>
                                <p>Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre
                                    mot de
                                    passe.</p>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}" class="needs-validation"
                                novalidate>
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="password-field position-relative">
                                            <label for="formSignupPassword"
                                                class="form-label visually-hidden">Password</label>
                                            <div class="password-field position-relative">
                                                <input type="password" name="password" class="form-control fakePassword"
                                                    id="formSignupPassword" placeholder="Mot de passe" required />
                                                <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                                <div class="invalid-feedback">Entrez votre mot de passe.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="password-field position-relative">
                                            <label for="formSignupPassword"
                                                class="form-label visually-hidden">Confirm password</label>
                                            <div class="password-field position-relative">
                                                <input type="password" name="password" class="form-control fakePassword"
                                                    id="formSignupPassword" placeholder="Confirmer mot de passe" required />
                                                <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                                <div class="invalid-feedback">Entrez votre mot de passe.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-grid gap-2">
                                        <button type="submit" class="btn btn-primary ">Enregistrer</button>
                                        <a href="{{route('login')}}" class="btn btn-light ">Continuer</a>
                                    </div>
                                </div>
                            </form>
                        </div>
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