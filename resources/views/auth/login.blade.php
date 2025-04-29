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
            overflow: hidden;
        }

        .splash-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeOut 0.5s ease 3.5s forwards;
        }

        .logo-animation-container {
            position: relative;
            width: 300px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: scale(0);
            animation: scaleIn 1.5s ease forwards;
        }

        .sta-text {
            position: absolute;
            left: 50%;
            transform: translateX(-100%);
            font-size: 38px;
            font-weight: 600;
            color: #21313c;
            opacity: 0;
            animation: fadeIn 0.8s ease 0.5s forwards;
        }

        .tion-text {
            position: absolute;
            left: 50%;
            transform: translateX(-14%);
            font-size: 38px;
            font-weight: 600;
            color: #21313c;
            opacity: 0;
            animation: fadeInTion 0.8s ease 1.6s forwards;
        }

        .flow-text {
            position: absolute;
            left: 50%;
            transform: translateX(-14%);
            font-size: 38px;
            font-weight: 600;
            color: #10B810;
            opacity: 0;
            z-index: 5;
            animation: slideInFlow 1s ease 0.8s forwards, moveFlow 0.8s ease 1.6s forwards;
        }

        .pump-icon {
            position: absolute;
            left: 25%;
            transform: translateX(-50%);
            opacity: 0;
            animation: fadeIn 0.8s ease 0.2s forwards;
        }

        .welcome-text {
            margin-top: 40px;
            font-size: 28px;
            color: #21313c;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease 2s forwards;
        }

        .loading-bar {
            width: 240px;
            height: 4px;
            background-color: #e9ecef;
            border-radius: 2px;
            margin-top: 30px;
            overflow: hidden;
            opacity: 0;
            animation: fadeIn 0.5s ease 2.2s forwards;
        }

        .loading-progress {
            height: 100%;
            width: 0;
            background-color: #10B810;
            animation: progress 1.2s ease 2.3s forwards;
        }

        .login-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            padding: 32px;
            width: 400px;
            max-width: 90%;
            opacity: 0;
            transform: scale(0.95);
            animation: showLogin 0.5s ease 3.8s forwards;
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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
            transition: border-color 0.15s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #10B810;
            outline: none;
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
        }

        .reset-link {
            color: #10B810;
            text-decoration: none;
            font-weight: 500;
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

        @keyframes fadeOut {
            from {
                opacity: 1;
                visibility: visible;
            }

            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInTion {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideInFlow {
            from {
                opacity: 0;
                transform: translateX(50%);
            }

            to {
                opacity: 1;
                transform: translateX(-14%);
            }
        }

        @keyframes moveFlow {
            from {
                transform: translateX(-14%);
            }

            to {
                transform: translateX(40%);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes progress {
            from {
                width: 0;
            }

            to {
                width: 100%;
            }
        }

        @keyframes showLogin {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Écran de bienvenue animé -->
    <div class="splash-container">
        <div class="logo-animation-container">
            <div class="pump-icon">
                <svg width="70" height="70" viewBox="0 0 70 70" xmlns="http://www.w3.org/2000/svg">
                    <g transform="translate(10, 0)">
                        <rect x="10" y="12" width="30" height="40" rx="3" fill="#10B810" />
                        <rect x="15" y="18" width="20" height="14" rx="2" fill="#ffffff" />
                        <path d="M40,25 L45,25 Q50,25 50,30 L50,45 Q50,52 45,52 L45,52" stroke="#10B810"
                            stroke-width="4" fill="none" />
                        <circle cx="45" cy="52" r="4" fill="#10B810" />
                        <rect x="16" y="38" width="18" height="8" rx="1" fill="#ffffff" />
                    </g>
                </svg>
            </div>
            <div class="sta-text">Sta</div>
            <div class="tion-text">tion</div>
            <div class="flow-text">Flow</div>
        </div>
        <div class="welcome-text">Bienvenue dans votre espace</div>
        <div class="loading-bar">
            <div class="loading-progress"></div>
        </div>
    </div>

    <!-- Page de connexion -->
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <svg width="200" height="60" viewBox="0 0 300 80" xmlns="http://www.w3.org/2000/svg">
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
                <p><small>Entrez vos identifiants pour accéder à votre espace</small></p>
            </div>
            <form class="needs-validation" novalidate method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row g-3">

                    <!-- Email Address -->
                    <div class="col-12">
                        <label for="formSignupEmail" class="form-label ">Adresse email</label>
                        <input type="email" id="email" class="form-control" name="email"
                            placeholder="Entrez votre email" required />
                        <div class="invalid-feedback">Votre E-mail !</div>
                    </div>
                    <!-- Password -->
                    <div class="col-12">
                        <div class="password-field position-relative">
                            <label for="formSignupPassword" class="form-label ">Mot de passe</label>
                            <div class="password-field position-relative">
                                <input type="password" class="form-control fakePassword" id="password" name="password"
                                    required placeholder="Entrez votre mot de passe" />
                                <span><i class="bi bi-eye-slash passwordToggler"></i></span>
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
        </div>
    </div>
</body>

</html>