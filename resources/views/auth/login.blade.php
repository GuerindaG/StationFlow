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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            padding: 32px;
            width: 400px;
            max-width: 100%;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header svg {
            margin-bottom: 20px;
        }

        .login-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #6c757d;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 16px;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.15s ease;
        }

        .form-group input:focus {
            border-color: #10B810;
            outline: none;
            box-shadow: 0 0 0 2px rgba(16, 184, 16, 0.1);
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            transition: color 0.15s ease;
        }

        .password-toggle:hover {
            color: #10B810;
        }

        .remember-reset {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
        }

        .remember-me input {
            margin-right: 8px;
            width: auto;
        }

        .remember-me label {
            margin-bottom: 0;
            font-size: 14px;
        }

        .reset-link {
            color: #10B810;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }

        .reset-link:hover {
            text-decoration: underline;
        }

        .login-button {
            display: block;
            width: 100%;
            padding: 14px;
            background-color: #10B810;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.15s ease;
        }

        .login-button:hover {
            background-color: #0ea00e;
        }

        .login-button:active {
            transform: translateY(1px);
        }

        .signup-link {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 14px;
        }

        .signup-link a {
            color: #10B810;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .divider {
            text-align: center;
            margin: 20px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #e9ecef;
        }

        .divider span {
            background-color: white;
            padding: 0 15px;
            color: #6c757d;
            font-size: 14px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }

        .success-message {
            background-color: #d1edff;
            color: #084298;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 14px;
            display: none;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <svg width="300" height="60" viewBox="0 0 300 80" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(20, 16) scale(0.9)">
                        <rect x="10" y="12" width="30" height="40" rx="3" fill="#10B810" />
                        <rect x="15" y="18" width="20" height="14" rx="2" fill="#ffffff" />
                        <path d="M40,25 L45,25 Q50,25 50,30 L50,45 Q50,52 45,52 L45,52" stroke="#10B810"
                            stroke-width="4" fill="none" />
                        <circle cx="45" cy="52" r="4" fill="#10B810" />
                        <rect x="16" y="38" width="18" height="8" rx="1" fill="#ffffff" />
                    </g>
                    <text x="70" y="40" font-family="Arial, sans-serif" font-size="26" font-weight="600"
                        fill="#21313c">Station</text>
                    <text x="160" y="40" font-family="Arial, sans-serif" font-size="26" font-weight="600"
                        fill="#10B810">Flow</text>
                    <text x="75" y="60" font-family="Arial, sans-serif" font-size="12" font-weight="400"
                        fill="#5c6c75">Gestion de stations-service</text>
                </svg>
                <h1>Connexion</h1>
                <p>Connectez-vous à votre compte</p>
            </div>
            
            <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row g-3">

                    <div class="col-12">
                        <label for="formSignupEmail" class="form-label ">Email</label>
                        <input type="email" id="email" class="form-control" name="email" placeholder="votre@email.com"
                            required />
                        <div class="invalid-feedback">Votre E-mail !</div>
                    </div>

                    <div class="col-12">
                        <div class="password-field position-relative">
                            <label for="formSignupPassword" class="form-label ">Mot de passe</label>
                            <div class="password-field position-relative">
                                <input type="password" class="form-control fakePassword" id="password" name="password"
                                    required placeholder="Entrez votre mot de passe" />
                                <span class="password-toggle" onclick="togglePassword()">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                    </svg>
                                </span>
                                <div class="invalid-feedback">Votre mot de passe !</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <!-- Remember Me -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="remember_me" name="remember" />
                            <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                        </div>
                        <div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 d-grid"> <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </div>
            </form>
            <div class="divider">
                <span>ou</span>
            </div>

            <div class="signup-link">
                Pas encore de compte ? <a href="register.html">Créer un compte</a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle svg');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.innerHTML = '<path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/>';
            } else {
                passwordInput.type = 'password';
                toggleIcon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>';
            }
        }   
    </script>
</body>

</html>