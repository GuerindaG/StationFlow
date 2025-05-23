<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('./assets/images/favicon/stationflow-favicon.svg')}}">
    <title>Rapport Journalier - {{ $station->nom }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #21313c;
            background-color: #f5f5f5;
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

        .station-id {
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
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #0aad0a;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .total-row {
            background-color: #f1f5f9 !important;
            font-weight: bold;
            border-top: 2px solid #0aad0a;
        }

        .amount {
            text-align: right;
            font-family: 'Courier New', monospace;
        }

        .summary-box {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 6px;
            margin: 25px 0;
            border-left: 4px solid #0aad0a;
        }

        .summary-box h3 {
            margin-top: 0;
            color: #0aad0a;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 16px;
            color: #21313c;
        }

        .final-amount {
            border-top: 2px solid #0aad0a;
            padding-top: 10px;
            font-weight: bold;
            font-size: 18px;
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
            color: #21313c;
        }

        .signature-title {
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

        .footer-right {
            text-align: right;
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
                <div class="station-id"><strong>Station:</strong> {{ $station->nom }}</div>
                <div class="date"><strong>Date:</strong> {{ $date->format('d F Y') }}</div>
            </div>
        </div>

        <div class="content">
            <div class="watermark">STATIONFLOW</div>

            <div class="section">
                <h2 class="section-title">État des stocks</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Catégorie</th>
                            <th>Produit</th>
                            <th class="amount">SI</th>
                            <th class="amount">Réceptions</th>
                            <th class="amount">SF</th>
                            <th class="amount">Sorties</th>
                            <th class="amount">SR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockData as $stock)
                            <tr>
                                @if($loop->first || $stock['categorie'] !== $stockData[$loop->index - 1]['categorie'])
                                    <td rowspan="{{ count(array_filter($stockData, fn($item) => $item['categorie'] === $stock['categorie'])) }}"
                                        style="vertical-align: middle; background-color: #f1f5f9; font-weight: bold;">
                                        {{ $stock['categorie'] }}
                                    </td>
                                @endif
                                <td>{{ $stock['produit'] }}</td>
                                <td class="amount">{{ number_format($stock['stock_initial'], 0, ',', ' ') }}</td>
                                <td class="amount">{{ number_format($stock['receptions'], 0, ',', ' ') }}</td>
                                <td class="amount">{{ number_format($stock['stock_final'], 0, ',', ' ') }}</td>
                                <td class="amount">{{ number_format($stock['sorties'], 0, ',', ' ') }}</td>
                                <td class="amount">{{ number_format($stock['stock_reste'], 0, ',', ' ') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 10px; font-size: 12px; color: #5c6c75; font-style: italic;">
                    <strong>Note :</strong> Stock Final <strong>(SF)</strong> = Stock Initial <strong>(SI)</strong> +
                    Réceptions | Stock Restant
                    <strong>(SR)</strong> = Stock Final <strong>(SF)</strong> -
                    Sorties
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Ventes par mode de paiement</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Mode de Paiement</th>
                            <th>Produit</th>
                            <th class="amount">Montant (F)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventesParPaiement as $mode => $ventes)
                            @php $first = true; @endphp
                            @foreach($ventes as $produitId => $items)
                                <tr>
                                    @if($first)
                                        <td rowspan="{{ count($ventes) + 1 }}"
                                            style="vertical-align: middle; background-color: #f1f5f9; font-weight: bold;">
                                            {{ $mode }}
                                        </td>
                                        @php $first = false; @endphp
                                    @endif
                                    <td>{{ $produits[$produitId]->nom }}</td>
                                    <td class="amount">{{ number_format($items->sum('montant_total'), 0, ',', ' ') }}</td>
                                </tr>
                            @endforeach
                            <tr class="total-row">
                                <td><strong>SOUS-TOTAL {{ $mode }}</strong></td>
                                <td class="amount"><strong>
                                        @if($mode === 'TICKETS VALEURS') {{ number_format($totalTV, 0, ',', ' ') }}
                                        @elseif($mode === 'JNP PASS') {{ number_format($totalJNP, 0, ',', ' ') }}
                                        @else {{ number_format($totalComptant, 0, ',', ' ') }}
                                        @endif
                                    </strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Ventes par produit</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th class="amount">Tickets Valeurs</th>
                            <th class="amount">JNP Pass</th>
                            <th class="amount">Comptant</th>
                            <th class="amount">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventesParProduit as $produitId => $ventes)
                            @php
                                $produit = $produits[$produitId];
                                $totalTV = $ventes->where('paiement_id', 1)->sum('montant_total');
                                $totalJNP = $ventes->where('paiement_id', 2)->sum('montant_total');
                                $totalComptant = $ventes->where('paiement_id', 3)->sum('montant_total');
                                $total = $totalTV + $totalJNP + $totalComptant;
                            @endphp
                            <tr>
                                <td><strong>{{ $produit->nom }}</strong></td>
                                <td class="amount">{{ number_format($totalTV, 0, ',', ' ') }}</td>
                                <td class="amount">{{ number_format($totalJNP, 0, ',', ' ') }}</td>
                                <td class="amount">{{ number_format($totalComptant, 0, ',', ' ') }}</td>
                                <td class="amount"><strong>{{ number_format($total, 0, ',', ' ') }}</strong></td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td><strong>TOTAL GÉNÉRAL</strong></td>
                            <td class="amount"><strong>{{ number_format($totalTV, 0, ',', ' ') }}</strong></td>
                            <td class="amount"><strong>{{ number_format($totalJNP, 0, ',', ' ') }}</strong></td>
                            <td class="amount"><strong>{{ number_format($totalComptant, 0, ',', ' ') }}</strong></td>
                            <td class="amount"><strong>{{ number_format($totalGeneral, 0, ',', ' ') }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="summary-box">
                <h3>RÉSUMÉ FINANCIER</h3>
                <div class="summary-item">
                    <span>Total des ventes à verser à la banque:</span>
                    <span>{{ number_format($totalComptant, 0, ',', ' ') }} F</span>
                </div>
                <div class="summary-item">
                    <span>Ticket de vente (TV):</span>
                    <span>1 000 F</span>
                </div>
                <div class="summary-item final-amount">
                    <span>RESTE À VERSER:</span>
                    <span>{{ number_format($totalComptant - 1000, 0, ',', ' ') }} F</span>
                </div>
            </div>

        </div>

        <div class="footer">
            <div>
                <div>© {{ now()->year }} StationFlow. Tous droits réservés.</div>
            </div>
            <div class="footer-right">
                <div>Rapport généré le {{ now()->format('d/m/Y à H:i') }}</div>
            </div>
        </div>
    </div>
</body>

</html>