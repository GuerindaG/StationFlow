<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approvisionnements du {{ $date_filter }} - StationFlow</title>
    <style>
        /* Simplifiez les styles pour une meilleure compatibilité */
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12px;
            color: #21313c;
        }

        .pdf-container {
            width: 100%;
            padding: 15mm;
        }

        /* Utilisez des bordures solides au lieu de border-radius */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #0aad0a;
            color: white;
            padding: 8px;
            text-align: left;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        /* Évitez les transformations CSS complexes */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(10, 173, 10, 0.1);
            z-index: 1;
        }
    </style>
</head>

<body>
    <div class="pdf-preview">
        <div class="header">
            <div style="flex-shrink: 0;">
                <img src="{{ public_path('assets/images/logo/stationflow-logo.png') }}" alt="Logo"
                    style="height: 60px;">
            </div>
            <div class="report-info">
                <h1><strong>
                        <center>Approvisionnements du {{ $date_filter }} - {{ $station->nom }}</center>
                    </strong></h1>
            </div>
        </div>

        <div class="content">
            <div class="watermark">STATIONFLOW</div>
            <div class="section">
                <table>
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Date</th>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Prix Unitaire</th>
                            <th>Montant Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($approvisionnements as $appro)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $appro->date_approvisionnement->format('d/m/Y') }}</td>
                                <td>{{ $appro->produit->nom }}</td>
                                <td>{{ $appro->produit->categorie->nom }}</td>
                                <td>{{ number_format($appro->qte_appro, 2, ',', ' ') }}</td>
                                <td>{{ number_format($appro->produit->prix_achat, 2, ',', ' ') }} F</td>
                                <td>{{ number_format($appro->montant_total, 2, ',', ' ') }} F</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 20px; text-align: right;">
                    <p><strong>Total Général: {{ number_format($approvisionnements->sum('montant_total'), 2, ',', ' ') }} F</strong></p>
                </div>
            </div>
        </div>
        <div class="footer">
            <div>© StationFlow - Tous droits réservés.</div>
            <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
</body>

</html>