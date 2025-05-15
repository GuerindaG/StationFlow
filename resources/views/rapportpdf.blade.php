<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de PDF généré - StationFlow</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .pdf-preview {
            width: 210mm;
            margin: 20px auto;
            padding: 20mm;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #1DB954;
            margin-bottom: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
            height: 60px;
        }

        .logo svg {
            height: 60px;
            width: 240px;
        }

        .subtitle {
            color: #7F8C8D;
            font-size: 14px;
        }

        .doc-info {
            text-align: right;
            color: #26303B;
            font-size: 12px;
        }

        .content {
            position: relative;
            min-height: 500px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 60px;
            color: rgba(200, 200, 200, 0.2);
            font-weight: bold;
            pointer-events: none;
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            color: #26303B;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #7F8C8D;
            display: flex;
            justify-content: space-between;
            color: #7F8C8D;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="pdf-preview">
        <div class="header">
            <div class="logo">
                <svg viewBox="0 0 300 80" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0" y="0" width="300" height="80" rx="8" fill="#ffffff" />
                    <g transform="translate(20, 16) scale(0.9)">
                        <rect x="10" y="12" width="30" height="40" rx="3" fill="#0aad0a" />
                        <rect x="15" y="18" width="20" height="14" rx="2" fill="#ffffff" />
                        <path d="M40,25 L45,25 Q50,25 50,30 L50,45 Q50,52 45,52 L45,52" stroke="#0aad0a"
                            stroke-width="4" fill="none" />
                        <circle cx="45" cy="52" r="4" fill="#0aad0a" />
                        <rect x="16" y="38" width="18" height="8" rx="1" fill="#ffffff" />
                    </g>
                    <text x="70" y="40" font-family="Arial, sans-serif" font-size="26" font-weight="600"
                        fill="#21313c">Station</text>
                    <text x="160" y="40" font-family="Arial, sans-serif" font-size="26" font-weight="600"
                        fill="#0aad0a">Flow</text>
                    <text x="75" y="60" font-family="Arial, sans-serif" font-size="12" font-weight="400"
                        fill="#5c6c75">Gestion de stations-service</text>
                </svg>
            </div>
            <div class="doc-info">
                <div style="font-weight: bold;">Rapport StationFlow</div>
                <div>Généré le: 15/05/2025</div>
                <div>à 14:30:25</div>
            </div>
        </div>

        <div class="content">
            <div class="watermark">StationFlow</div>

            <h2>Liste des Stations-Service</h2>

            <table class="content-to-export">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom de la Station</th>
                        <th>Adresse</th>
                        <th>Ville</th>
                        <th>Code Postal</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>001</td>
                        <td>Station Centrale</td>
                        <td>123 Avenue Principale</td>
                        <td>Paris</td>
                        <td>75001</td>
                        <td>Actif</td>
                    </tr>
                    <tr>
                        <td>002</td>
                        <td>Station Express</td>
                        <td>45 Rue du Commerce</td>
                        <td>Lyon</td>
                        <td>69002</td>
                        <td>Actif</td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>Station Rapide</td>
                        <td>78 Boulevard Maritime</td>
                        <td>Marseille</td>
                        <td>13001</td>
                        <td>En maintenance</td>
                    </tr>
                    <tr>
                        <td>004</td>
                        <td>Station Est</td>
                        <td>12 Place du Marché</td>
                        <td>Strasbourg</td>
                        <td>67000</td>
                        <td>Actif</td>
                    </tr>
                    <tr>
                        <td>005</td>
                        <td>Station Ouest</td>
                        <td>56 Avenue de l'Océan</td>
                        <td>Nantes</td>
                        <td>44000</td>
                        <td>Actif</td>
                    </tr>
                </tbody>
            </table>

            <p>Ce rapport présente la liste complète des stations-service enregistrées dans le système StationFlow. Les
                informations sont mises à jour quotidiennement et reflètent l'état actuel du réseau.</p>
        </div>

        <div class="footer">
            <div>© 2025 StationFlow - Tous droits réservés</div>
            <div>Page 1</div>
        </div>
    </div>
</body>

</html>