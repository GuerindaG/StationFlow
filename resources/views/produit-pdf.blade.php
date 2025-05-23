<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste produits - StationFlow</title>
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
            font-size: 80px;
            color: rgba(10, 173, 10, 0.1);
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="pdf-preview">
        <div class="header">
            <div class="logo-container">
                <img src="{{ storage_path('StationFlow/public/assets/images/logo/stationflow-logo.svg ') }}" width="150">
            </div>
            <div class="report-info">
                <h1>Liste des produits</h1>
                <div class="date">{{ $dateGeneration }}</div>
                <div class="station-id"></div>
            </div>
        </div>
        <div class="content">
            <div class="watermark">STATIONFLOW</div>
            <!-- PRODUITS BLANCS -->
            <div class="section">
                <h2 class="section-title">Produits blancs</h2>
                @php
                    $produitsBlancs = $produits->filter(fn($p) => $p->categorie->nom === 'Produits blancs');
                @endphp
                @if($produitsBlancs->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Désignation</th>
                                <th>Viscosité</th>
                                <th>Prix d'achat</th>
                                <th>Prix de vente</th>
                                <th>Marge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produitsBlancs as $produit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produit->nom }}</td>
                                    <td>{{ $produit->viscosite ?? 'Néant'}}</td>
                                    <td>{{ number_format($produit->prix_achat, 0, ',', ' ') }} F</td>
                                    <td>{{ number_format($produit->prix_vente, 0, ',', ' ') }} F</td>
                                    <td>{{ $marge = $produit->prix_vente - $produit->prix_achat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-category">Aucun produit blanc disponible</div>
                @endif
            </div>
            <!-- GAZ & ACCESSOIRES -->
            <div class="section">
                <h2 class="section-title">Gaz & accessoires</h2>
                @php
                    $produitsGaz = $produits->filter(fn($p) => $p->categorie->nom === 'Gaz et accessoires');
                @endphp
                @if($produitsGaz->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Désignation</th>
                                <th>Viscosité</th>
                                <th>Prix d'achat</th>
                                <th>Prix de vente</th>
                                <th>Marge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produitsGaz as $produit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produit->nom }}
                                    </td>
                                    <td>{{ $produit->viscosite ?? 'Néant'}}</td>
                                    <td>{{ number_format($produit->prix_achat, 0, ',', ' ') }} F</td>
                                    <td>{{ number_format($produit->prix_vente, 0, ',', ' ') }} F</td>
                                    <td>{{ $marge = $produit->prix_vente - $produit->prix_achat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-category">Aucun produit gaz & accessoires disponible</div>
                @endif
            </div>
            <!-- LUBRIFIANTS -->
            <div class="section">
                <h2 class="section-title">Lubrifiants</h2>
                @php
                    $produitsLub = $produits->filter(fn($p) => $p->categorie->nom === 'Lubrifiants');
                @endphp
                @if($produitsLub->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Désignation</th>
                                <th>Viscosité</th>
                                <th>Prix d'achat</th>
                                <th>Prix de vente</th>
                                <th>Marge</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produitsLub as $produit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produit->nom }}
                                    </td>
                                    <td>{{ $produit->viscosite ?? 'Néant'}}</td>
                                    <td>{{ number_format($produit->prix_achat, 0, ',', ' ') }} F</td>
                                    <td>{{ number_format($produit->prix_vente, 0, ',', ' ') }} F</td>
                                    <td>{{ $marge = $produit->prix_vente - $produit->prix_achat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-category">Aucun produit lubrifiant disponible</div>
                @endif
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