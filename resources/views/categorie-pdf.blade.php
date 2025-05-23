<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste catégories - StationFlow</title>
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
                <h1>Liste des catégories</h1>
                <div class="date">{{ $dateGeneration }}</div>
                <div class="station-id"></div>
            </div>
        </div>

        <div class="content">
            <div class="watermark">STATIONFLOW</div>
            <div class="section">
                <h2 class="section-title">Liste des catégories</h2>
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Désignation</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorie as $categories)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $categories->nom }}</td>
                                <td><small>{{ $categories->description }}</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="footer">
            <div>&copy; {{ date('Y') }} StationFlow - Tous droits réservés</div>
            <div class="footer-right">
                <div class="footer-right">Rapport généré le : <strong>{{ date('d/m/Y à H:i') }}</strong></div>
                <div>Page 1/1</div>
            </div>
        </div>
    </div>
</body>

</html>