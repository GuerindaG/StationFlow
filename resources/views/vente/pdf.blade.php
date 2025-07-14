<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vente du {{ $date_filter }} - StationFlow</title>
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

        .header-info {
            text-align: right;
            flex: 1;
            padding-left: 20px;
        }

        .header-info h1 {
            font-size: 24px;
            margin: 0 0 5px 0;
            color: #0aad0a;
        }

        .header-info .station {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #21313c;
        }

        .header-info .date {
            font-size: 14px;
            color: #5c6c75;
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
            <div class="header-info">
                <h1>Rapport des ventes</h1>
                <div class="station"><strong>Station :</strong> {{ $station->nom ?? 'Nom de la station inconnu' }}</div>
                <div class="date">Date : {{ $date_filter }}</div>
                @if($categorie_filter)
                    <p><strong>Catégorie:</strong> {{ \App\Models\Categorie::find($categorie_filter)->nom }}</p>
                @endif
            </div>
        </div>

        <div class="content">
            <div class="watermark">STATIONFLOW</div>
            <div class="section">
                <table>
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Ticket Valeur</th>
                            <th>JNP Pass</th>
                            <th>Espèces</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $grandTotal = 0;
                            $totalTV = 0;
                            $totalJNP = 0;
                            $totalEspeces = 0;
                        @endphp

                        @foreach($ventesGrouped as $produitId => $ventesProduit)
                            @php
                                $produit = $ventesProduit->first()->produit;

                                $quantiteTotale = $ventesProduit->sum('quantite');

                                $tv = $ventesProduit->where('paiement.nom', 'Ticket Valeur');
                                $montantTV = $tv->sum('montant_total');
                                $totalTV += $montantTV;

                                $jnp = $ventesProduit->where('paiement.nom', 'JNP Pass');
                                $montantJNP = $jnp->sum('montant_total');
                                $totalJNP += $montantJNP;

                                $especes = $ventesProduit->where('paiement.nom', 'Espèce');
                                $montantEspeces = $especes->sum('montant_total');
                                $totalEspeces += $montantEspeces;

                                $totalProduit = $montantTV + $montantJNP + $montantEspeces;
                                $grandTotal += $totalProduit;
                            @endphp

                            <tr>
                                <td>{{ $produit->nom }}</td>
                                <td>{{ $produit->categorie->nom ?? 'N/A' }}</td>
                                <td>{{ number_format($quantiteTotale, 0, ',', ' ') }}</td>
                                <td>{{ number_format($montantTV, 0, ',', ' ') }} XOF</td>
                                <td>{{ number_format($montantJNP, 0, ',', ' ') }} XOF</td>
                                <td>{{ number_format($montantEspeces, 0, ',', ' ') }} XOF</td>
                                <td>{{ number_format($totalProduit, 0, ',', ' ') }} XOF</td>
                            </tr>
                        @endforeach

                        <tr class="total-row">
                            <td colspan="3">Total Général</td>
                            <td>{{ number_format($totalTV, 0, ',', ' ') }} XOF</td>
                            <td>{{ number_format($totalJNP, 0, ',', ' ') }} XOF</td>
                            <td>{{ number_format($totalEspeces, 0, ',', ' ') }} XOF</td>
                            <td>{{ number_format($grandTotal, 0, ',', ' ') }} XOF</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="footer">
            <div>© StationFlow - Tous droits réservés.</div>
            <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
        </div>
    </div>
</body>

</html>