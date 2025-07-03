<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Station introuvable | StationFlow</title>
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

        .error-icon {
            font-size: 180px;
            color: rgba(220, 53, 69, 0.15);
            line-height: 0.8;
            position: relative;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
        }

        .search-animation {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120px;
            height: 120px;
        }

        .search-pulse {
            position: absolute;
            border: 3px solid #dc3545;
            border-radius: 50%;
            animation: searchPulse 2s infinite;
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

        .station-illustration {
            max-width: 300px;
            margin-top: 20px;
            position: relative;
        }

        /* Animation pour la recherche */
        @keyframes searchPulse {
            0% {
                width: 40px;
                height: 40px;
                opacity: 1;
            }
            100% {
                width: 120px;
                height: 120px;
                opacity: 0;
            }
        }

        /* Animation pour la station fermée */
        @keyframes fadeInOut {
            0%, 100% {
                opacity: 0.3;
            }
            50% {
                opacity: 1;
            }
        }

        .closed-station {
            animation: fadeInOut 3s infinite ease-in-out;
        }

        /* Animation pour le point d'interrogation */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .bounce-element {
            animation: bounce 2s infinite;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .error-content {
                flex-direction: column-reverse;
            }

            .error-icon {
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
                    <h1 class="error-title">Station introuvable</h1>
                    <p class="error-message">La station-service que vous recherchez n'existe pas dans notre base de données. Vérifiez l'identifiant ou recherchez parmi nos stations disponibles.</p>
                    <div class="buttons">
                        <a href="javascript:history.back()" class="btn btn-secondary">
                            <span>← Retour</span>
                        </a>
                        <a href="/stations" class="btn btn-primary">
                            <span>Voir toutes les stations</span>
                        </a>
                    </div>
                </div>

                <div class="error-visual">
                    <div class="error-icon bounce-element">❓</div>
                    <div class="station-illustration">
                        <svg width="100%" height="100%" viewBox="0 0 240 200" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <!-- Station-service fermée/inexistante -->
                            <rect x="40" y="80" width="120" height="80" fill="#6c757d" rx="5" class="closed-station" />
                            <rect x="50" y="90" width="100" height="60" fill="#e9ecef" rx="3" class="closed-station" />
                            <rect x="70" y="130" width="60" height="30" fill="#f8f9fa" class="closed-station" />
                            <rect x="85" y="130" width="30" height="30" fill="#dc3545" class="closed-station" />

                            <!-- Pompe fermée -->
                            <rect x="150" y="110" width="30" height="50" fill="#6c757d" rx="3" class="closed-station" />
                            <rect x="155" y="115" width="20" height="30" fill="#e9ecef" rx="2" class="closed-station" />
                            <path
                                d="M165 150 L165 170 L175 170 L175 165 L170 165 L170 160 L180 160 L180 170 L190 170 L190 150"
                                stroke="#dc3545" stroke-width="4" fill="none" class="closed-station" />

                            <!-- Panneaux "Fermé" -->
                            <rect x="60" y="100" width="80" height="15" fill="#dc3545" rx="2" />
                            <text x="100" y="110" text-anchor="middle" fill="white" font-size="8" font-weight="bold">FERMÉ</text>

                            <!-- Cercles de recherche animés -->
                            <g class="search-animation">
                                <circle class="search-pulse" cx="60" cy="60" r="20" style="animation-delay: 0s;" />
                                <circle class="search-pulse" cx="60" cy="60" r="20" style="animation-delay: 0.7s;" />
                                <circle class="search-pulse" cx="60" cy="60" r="20" style="animation-delay: 1.4s;" />
                            </g>

                            <!-- Nuages gris -->
                            <ellipse cx="50" cy="40" rx="20" ry="10" fill="rgba(108, 117, 125, 0.2)" />
                            <ellipse cx="190" cy="30" rx="25" ry="12" fill="rgba(108, 117, 125, 0.2)" />
                            
                            <!-- Icône de recherche -->
                            <circle cx="200" cy="50" r="15" fill="none" stroke="#dc3545" stroke-width="3" />
                            <line x1="210" y1="60" x2="220" y2="70" stroke="#dc3545" stroke-width="3" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>