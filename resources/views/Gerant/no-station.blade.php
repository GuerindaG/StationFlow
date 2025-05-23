<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page non trouvée | StationFlow</title>
    <link rel="shortcut icon" type="" href="{{ asset('./assets/images/favicon/favicon.ico')}}" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #212529;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            padding: 30px 0;
            text-align: center;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .logo-icon {
            font-size: 60px;
            color: #14bd0b;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 44px;
            font-weight: 600;
        }

        .logo-text-dark {
            color: #1e2a38;
        }

        .logo-text-green {
            color: #14bd0b;
        }

        .tagline {
            color: #6c757d;
            font-size: 24px;
            margin-top: 5px;
        }

        .error-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 50px 20px;
            text-align: center;
        }

        .error-content {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            gap: 40px;
        }

        .error-text {
            max-width: 500px;
        }

        .error-title {
            font-size: 36px;
            font-weight: 700;
            color: #1e2a38;
            margin-bottom: 20px;
        }

        .error-message {
            font-size: 18px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .error-visual {
            position: relative;
        }

        .error-number {
            font-size: 180px;
            font-weight: 800;
            color: rgba(20, 189, 11, 0.15);
            line-height: 0.8;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
        }

        .pump-animation {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
        }

        .fuel-drop {
            position: absolute;
            background-color: #14bd0b;
            border-radius: 50%;
            animation: drop 2s infinite;
        }

        .buttons {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #14bd0b;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #108e09;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(20, 189, 11, 0.2);
        }

        .btn-secondary {
            background-color: #1e2a38;
            color: white;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #121a23;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(30, 42, 56, 0.2);
        }

        .gas-station-illustration {
            max-width: 300px;
            margin-top: 20px;
            position: relative;
        }

        /* Animation pour les gouttelettes de carburant */
        @keyframes drop {
            0% {
                top: 0;
                opacity: 0;
                width: 10px;
                height: 10px;
            }

            50% {
                opacity: 1;
                width: 15px;
                height: 15px;
            }

            100% {
                top: 120px;
                opacity: 0;
                width: 10px;
                height: 10px;
            }
        }

        /* Animation pour la pompe */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .animated-element {
            animation: pulse 2s infinite ease-in-out;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .error-content {
                flex-direction: column-reverse;
            }

            .error-number {
                font-size: 140px;
            }

            .buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <div class="logo-icon">⛽</div>
                <div class="logo-text">
                    <span class="logo-text-dark">Station</span><span class="logo-text-green">Flow</span>
                </div>
            </div>
            <div class="tagline">Gestion de stations-service</div>
        </div>

        <div class="error-container">
            <div class="error-content">
                <div class="error-text">
                    <h1 class="error-title">Oops ! La pompe est à sec.</h1>
                    <p class="error-message">La page que vous recherchez n'existe pas ou a été déplacée. Peut-être
                        avez-vous pris le mauvais chemin ?</p>
                    <div class="buttons">
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <span>← Retour</span>
                        </a>
                        <a href="/" class="btn btn-primary">
                            <span>Retour à l'accueil</span>
                        </a>
                    </div>
                </div>

                <div class="error-visual">
                    <div class="error-number animated-element">404</div>
                    <div class="gas-station-illustration">
                        <svg width="100%" height="100%" viewBox="0 0 240 200" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- Station-service stylisée -->
                            <rect x="40" y="80" width="120" height="80" fill="#14bd0b" rx="5" />
                            <rect x="50" y="90" width="100" height="60" fill="white" rx="3" />
                            <rect x="70" y="130" width="60" height="30" fill="#f8f9fa" />
                            <rect x="85" y="130" width="30" height="30" fill="#14bd0b" />

                            <!-- Pompe à essence -->
                            <rect x="150" y="110" width="30" height="50" fill="#1e2a38" rx="3" />
                            <rect x="155" y="115" width="20" height="30" fill="#f8f9fa" rx="2" />
                            <path
                                d="M165 150 L165 170 L175 170 L175 165 L170 165 L170 160 L180 160 L180 170 L190 170 L190 150"
                                stroke="#14bd0b" stroke-width="4" fill="none" />

                            <!-- Gouttes animées -->
                            <circle class="fuel-drop" cx="165" cy="20" r="5" style="animation-delay: 0s;" />
                            <circle class="fuel-drop" cx="165" cy="40" r="5" style="animation-delay: 0.7s;" />
                            <circle class="fuel-drop" cx="165" cy="60" r="5" style="animation-delay: 1.4s;" />

                            <!-- Nuages stylisés -->
                            <ellipse cx="50" cy="40" rx="20" ry="10" fill="rgba(20, 189, 11, 0.1)" />
                            <ellipse cx="190" cy="30" rx="25" ry="12" fill="rgba(20, 189, 11, 0.1)" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>