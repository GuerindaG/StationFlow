<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Page expirée | StationFlow</title>
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

        /* Animation pour la station */
        @keyframes fadeInOut {
            0% {
                opacity: 0.5;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0.5;
            }
        }

        /* Animation pour l'horloge */
        @keyframes clockRotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .clock-hand {
            transform-origin: center;
            animation: clockRotate 10s linear infinite;
        }

        .hour-hand {
            transform-origin: center;
            animation: clockRotate 60s linear infinite;
        }

        .fading {
            animation: fadeInOut 3s infinite ease-in-out;
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
                    <h1 class="error-title">Votre session a expiré !</h1>
                    <p class="error-message">La page que vous avez demandée a expiré pour des raisons de sécurité.
                        Veuillez rafraîchir votre page et réessayer.</p>
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
                    <div class="error-number">419</div>
                    <div class="gas-station-illustration">
                        <svg width="100%" height="100%" viewBox="0 0 240 200" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- Station-service qui s'estompe -->
                            <g class="fading">
                                <rect x="40" y="100" width="120" height="80" fill="#14bd0b" rx="5" opacity="0.5" />
                                <rect x="50" y="110" width="100" height="60" fill="white" rx="3" opacity="0.5" />
                                <rect x="70" y="150" width="60" height="30" fill="#f8f9fa" opacity="0.5" />
                            </g>

                            <!-- Pompe à essence -->
                            <rect x="180" y="120" width="30" height="60" fill="#1e2a38" rx="3" />
                            <rect x="185" y="125" width="20" height="30" fill="#f8f9fa" rx="2" />

                            <!-- Horloge pour symboliser l'expiration -->
                            <circle cx="120" cy="60" r="40" fill="#f8f9fa" stroke="#14bd0b" stroke-width="4" />
                            <circle cx="120" cy="60" r="3" fill="#1e2a38" />

                            <!-- Aiguilles de l'horloge -->
                            <line x1="120" y1="60" x2="120" y2="30" stroke="#1e2a38" stroke-width="3"
                                stroke-linecap="round" class="hour-hand" />
                            <line x1="120" y1="60" x2="145" y2="60" stroke="#e63946" stroke-width="2"
                                stroke-linecap="round" class="clock-hand" />

                            <!-- Repères des heures -->
                            <line x1="120" y1="22" x2="120" y2="28" stroke="#1e2a38" stroke-width="2" />
                            <line x1="120" y1="92" x2="120" y2="98" stroke="#1e2a38" stroke-width="2" />
                            <line x1="82" y1="60" x2="88" y2="60" stroke="#1e2a38" stroke-width="2" />
                            <line x1="152" y1="60" x2="158" y2="60" stroke="#1e2a38" stroke-width="2" />

                            <!-- Sablier représentant le temps écoulé -->
                            <path d="M180 40 L200 40 L190 60 L200 80 L180 80 L190 60 Z" fill="#f8f9fa" stroke="#14bd0b"
                                stroke-width="2" />
                            <path d="M185 45 L195 45 L190 55 Z" fill="#14bd0b" />

                            <!-- Symbole d'expiration -->
                            <text x="80" y="160" font-family="Arial" font-size="14" fill="#e63946" font-weight="bold"
                                class="fading">SESSION EXPIRÉE</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>