<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="guerindagg" />
    <title>StationFlow - Mot de passe oublié</title>
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

        .forgot-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            padding: 32px;
            width: 400px;
            max-width: 90%;
            opacity: 1;
            transform: scale(1);
        }

        .forgot-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .forgot-header svg {
            margin-bottom: 20px;
        }

        .forgot-header h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .forgot-header p {
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

        .forgot-button {
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

        .forgot-button:hover {
            background-color: #0ea00e;
        }
    </style>
</head>

<body>
    <div class="forgot-container">
        <div class="forgot-card">
            <div class="forgot-header">
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
                <h1>Mot de passe oublié ?</h1>
                <p><small>Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de
                        passe.</small></p>
            </div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="needs-validation" novalidate method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row g-3">

                    <!-- Email Address -->
                    <div class="col-12">
                        <label for="formSignupEmail" class="form-label ">Adresse email</label>
                        <input type="email" id="email" class="form-control" :value="old('email')" name="email"
                            placeholder="Entrez votre email" required />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                    <div class="divider">

                    </div>

                    <div class=" text-center">
                        <a href="{{route('login')}}">
                            Retour à la connexion
                        </a>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>