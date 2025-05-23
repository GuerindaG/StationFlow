<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Journalier - StationFlow</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #21313c;
        }

        .pdf-preview {
            width: 210mm;
            margin: 20px auto;
            padding: 20mm;
            background-color: white;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .logo-container {
            width: 200px;
        }

        .report-info {
            text-align: right;
        }

        .report-info h1 {
            font-size: 24px;
            margin: 0 0 10px 0;
            color: #0aad0a;
        }

        .report-info .date {
            font-size: 14px;
            color: #5c6c75;
        }

        .content {
            position: relative;
            min-height: 500px;
            z-index: 2;
        }

        .section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #0aad0a;
            font-weight: 600;
            padding-bottom: 5px;
            border-bottom: 2px solid #0aad0a;
        }

        .info-block {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            flex: 1;
            min-width: 200px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #0aad0a;
        }

        .info-item .label {
            font-size: 12px;
            color: #5c6c75;
            margin-bottom: 5px;
        }

        .info-item .value {
            font-size: 18px;
            font-weight: 600;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(10, 173, 10, 0.05);
            font-weight: bold;
            pointer-events: none;
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 20px 0;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border: none;
        }

        th {
            background-color: #0aad0a;
            color: white;
            font-weight: 500;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        td {
            border-bottom: 1px solid #e9ecef;
        }

        .stat-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
        }

        .stat-card {
            flex: 1;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
            text-align: center;
            border-bottom: 3px solid #0aad0a;
        }

        .stat-card .stat-value {
            font-size: 24px;
            font-weight: 600;
            color: #21313c;
            margin-bottom: 5px;
        }

        .stat-card .stat-label {
            font-size: 12px;
            color: #5c6c75;
        }

        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #5c6c75;
            font-size: 12px;
        }

        .footer .qr-code {
            width: 60px;
            height: 60px;
            background-color: #f8f9fa;
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer-right {
            text-align: right;
        }

        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .signature-block {
            width: 45%;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #21313c;
            margin-top: 50px;
            margin-bottom: 5px;
        }

        .signature-name {
            font-weight: 600;
        }

        .signature-title {
            font-size: 12px;
            color: #5c6c75;
        }
    </style>
</head>

<body>
    <div class="pdf-preview">
        <div class="header">
            <div class="logo-container">
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
            <div class="report-info">
                <h1>Rapport Journalier</h1>
                <div class="date">20 mai 2025</div>
                <div class="station-id">Station #542 - Paris Nord</div>
            </div>
        </div>

        <div class="content">
            <div class="watermark">STATIONFLOW</div>
            <div class="section">
                <h2 class="section-title">Résumé de performance</h2>
                <div class="stat-cards">
                    <div class="stat-card">
                        <div class="stat-value">8,650 €</div>
                        <div class="stat-label">CA Ticket valeur</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">785</div>
                        <div class="stat-label">CA JNP pass</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">11.02 €</div>
                        <div class="stat-label">CA  moyen</div>
                    </div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Ventes par type de carburant</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Volume (L)</th>
                            <th>Prix unitaire</th>
                            <th>CA</th>
                            <th>% du CA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>SP95-E10</td>
                            <td>2,450</td>
                            <td>1.85 €</td>
                            <td>4,532.50 €</td>
                            <td>52.4%</td>
                        </tr>
                        <tr>
                            <td>Gazole</td>
                            <td>1,890</td>
                            <td>1.75 €</td>
                            <td>3,307.50 €</td>
                            <td>38.2%</td>
                        </tr>
                        <tr>
                            <td>SP98</td>
                            <td>350</td>
                            <td>1.95 €</td>
                            <td>682.50 €</td>
                            <td>7.9%</td>
                        </tr>
                        <tr>
                            <td>GPLc</td>
                            <td>105</td>
                            <td>0.98 €</td>
                            <td>102.90 €</td>
                            <td>1.2%</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>4,795</strong></td>
                            <td>-</td>
                            <td><strong>8,625.40 €</strong></td>
                            <td><strong>100%</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Ventes boutique</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Nombre d'articles</th>
                            <th>CA</th>
                            <th>% du CA boutique</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Boissons</td>
                            <td>145</td>
                            <td>362.50 €</td>
                            <td>42.1%</td>
                        </tr>
                        <tr>
                            <td>Snacks</td>
                            <td>98</td>
                            <td>245.00 €</td>
                            <td>28.5%</td>
                        </tr>
                        <tr>
                            <td>Produits auto</td>
                            <td>12</td>
                            <td>180.00 €</td>
                            <td>20.9%</td>
                        </tr>
                        <tr>
                            <td>Tabac</td>
                            <td>15</td>
                            <td>75.00 €</td>
                            <td>8.7%</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>270</strong></td>
                            <td><strong>862.50 €</strong></td>
                            <td><strong>100%</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Moyens de paiement</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Nombre</th>
                            <th>Montant</th>
                            <th>% du CA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Carte bancaire</td>
                            <td>628</td>
                            <td>7,345.75 €</td>
                            <td>84.9%</td>
                        </tr>
                        <tr>
                            <td>Espèces</td>
                            <td>132</td>
                            <td>982.65 €</td>
                            <td>11.4%</td>
                        </tr>
                        <tr>
                            <td>Carte carburant</td>
                            <td>25</td>
                            <td>321.50 €</td>
                            <td>3.7%</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>785</strong></td>
                            <td><strong>8,649.90 €</strong></td>
                            <td><strong>100%</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="signature-section">
                <div class="signature-block">
                </div>
                <div class="signature-block">
                    <div class="signature-name">Marie Lefort</div>
                    <div class="signature-title">Responsable régional</div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div>
                <div>StationFlow SAS - 123 Avenue de la République, 75011 Paris</div>
                <div>SIRET: 123 456 789 00012 - TVA: FR 12 345 678 900</div>
            </div>
            <div class="footer-right">
                <div>Rapport généré le 20/05/2025 à 23:59</div>
                <div>Document confidentiel - Page 1/1</div>
            </div>
        </div>
    </div>
</body>

</html>