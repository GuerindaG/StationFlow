<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Station Flow - Chargement</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
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
    </style>
</head>

<body>
    <div class="logo-animation-container">
        <div class="pump-icon">
            <svg width="70" height="70" viewBox="0 0 70 70" xmlns="http://www.w3.org/2000/svg">
                <g transform="translate(10, 0)">
                    <rect x="10" y="12" width="30" height="40" rx="3" fill="#10B810" />
                    <rect x="15" y="18" width="20" height="14" rx="2" fill="#ffffff" />
                    <path d="M40,25 L45,25 Q50,25 50,30 L50,45 Q50,52 45,52 L45,52" stroke="#10B810" stroke-width="4"
                        fill="none" />
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

    <script>
        setTimeout(() => {
            window.location.href = ' /login'
        }, 3500); 
    </script>
</body>

</html>