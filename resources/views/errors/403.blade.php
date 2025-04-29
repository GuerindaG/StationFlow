<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Accès interdit | StationFlow</title>
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

        /* Animation pour le panneau qui bouge */
        @keyframes wiggle {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(5deg);
            }

            50% {
                transform: rotate(0deg);
            }

            75% {
                transform: rotate(-5deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        /* Animation pour la chaîne */
        @keyframes sway {
            0% {
                transform: rotate(-2deg);
            }

            50% {
                transform: rotate(2deg);
            }

            100% {
                transform: rotate(-2deg);
            }
        }

        .chain {
            transform-origin: top;
            animation: sway 3s infinite ease-in-out;
        }

        .sign {
            transform-origin: center;
            animation: wiggle 5s infinite ease-in-out;
        }

        /* Animation pour le clignotement */
        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }

            100% {
                opacity: 1;
            }
        }

        .blinking {
            animation: blink 2s infinite;
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
                    <h1 class="error-title">Zone réservée !</h1>
                    <p class="error-message">Vous n'avez pas l'autorisation d'accéder à cette section. Cette zone est
                        réservée au personnel autorisé.</p>
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
                    <div class="error-number">403</div>
                    <div class="gas-station-illustration">
                        <svg width="100%" height="100%" viewBox="0 0 240 200" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- Station-service -->
                            <rect x="40" y="120" width="120" height="60" fill="#14bd0b" rx="5" />
                            <rect x="50" y="130" width="100" height="40" fill="white" rx="3" />

                            <!-- Panneau "Accès interdit" -->
                            <g class="sign">
                                <!-- Panneau -->
                                <rect x="140" y="60" width="60" height="40" fill="#e63946" rx="5" />
                                <rect x="145" y="65" width="50" height="30" fill="white" rx="3" />
                                <text x="170" y="85" text-anchor="middle" font-size="12" font-weight="bold"
                                    fill="#e63946" class="blinking">ACCÈS INTERDIT</text>

                                <!-- Chaînes de suspension -->
                                <g class="chain">
                                    <line x1="150" y1="30" x2="150" y2="60" stroke="#6c757d" stroke-width="2"
                                        stroke-dasharray="4 2" />
                                    <line x1="190" y1="30" x2="190" y2="60" stroke="#6c757d" stroke-width="2"
                                        stroke-dasharray="4 2" />
                                </g>

                                <!-- Symbole d'interdiction -->
                                <circle cx="125" y="80" r="15" fill="#e63946" />
                                <line x1="115" y1="70" x2="135" y2="90" stroke="white" stroke-width="3" />
                                <line x1="135" y1="70" x2="115" y2="90" stroke="white" stroke-width="3" />
                            </g>

                            <!-- Pompe à essence avec cadenas -->
                            <rect x="80" y="90" width="30" height="50" fill="#1e2a38" rx="3" />
                            <rect x="85" y="95" width="20" height="30" fill="#f8f9fa" rx="2" />
                            <path d="M95 140 L95 150" stroke="#14bd0b" stroke-width="4" fill="none" />

                            <!-- Cadenas -->
                            <rect x="87" y="90" width="16" height="12" fill="#ffc107" rx="2" />
                            <rect x="93" y="85" width="4" height="8" fill="#ffc107" rx="1" />
                            <circle cx="95" cy="93" r="2" fill="#212529" />

                            <!-- Barrière -->
                            <rect x="40" y="100" width="10" height="60" fill="#6c757d" />
                            <rect x="40" y="100" width="100" height="10" fill="#f8f9fa" />
                            <rect x="50" y="100" width="10" height="10" fill="#e63946" />
                            <rect x="70" y="100" width="10" height="10" fill="#e63946" />
                            <rect x="90" y="100" width="10" height="10" fill="#e63946" />
                            <rect x="110" y="100" width="10" height="10" fill="#e63946" />
                            <rect x="130" y="100" width="10" height="60" fill="#6c757d" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>