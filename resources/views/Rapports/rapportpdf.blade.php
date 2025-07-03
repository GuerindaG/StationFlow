<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Rapport Journalier - StationFlow</title>
    <style>
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
            align-items: flex-start;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .logo-container {
            width: 200px;
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

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
            color: rgba(10, 173, 10, 0.1);
            z-index: 1;
            pointer-events: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th {
            background-color: #0aad0a;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
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

        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #0aad0a;
            font-weight: 600;
            padding-bottom: 5px;
            border-bottom: 2px solid #0aad0a;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            font-size: 10px;
            color: #5c6c75;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo-container">
            <img src="{{ public_path('assets/images/logo/stationflow-logo.png') }}" alt="Logo" style="height: 70px;">
        </div>

        <div class="header-info">
            <h1>Rapport Journalier</h1>
            <div class="station"><strong>Station :</strong> {{ $station->nom ?? 'Nom de la station inconnu' }}</div>
            <div class="date">Date : {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</div>
        </div>
    </div>

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
                    <th class="amount">Sorties</th>
                    <th class="amount">SF</th>
                    <th class="amount">SR</th>
                </tr>
            </thead>
            <tbody>
                @php
                    function afficherMontant($valeur)
                    {
                        return $valeur ? number_format($valeur, 2, ',', ' ') : 'Néant';
                    }
                @endphp

                @foreach($categories as $categorie)
                    @php
                        $produitsCategorie = $categorie->produits;
                        $nbProduits = $produitsCategorie->count();
                    @endphp

                    @foreach($produitsCategorie as $index => $produit)
                        @php
                            $appro = $approvisionnements->where('produit_id', $produit->id)->sum('qte_appro');
                            $vente = $ventes->where('produit_id', $produit->id)->sum('quantite');

                            $stock_jour = $stocks_journaliers->where('produit_id', $produit->id)->first();
                            $stock = $stocks->where('produit_id', $produit->id)->first();

                            $SF = $stock_jour?->stock_finale ?? $stock?->qte_actuelle ?? 0;
                            $SI = $SF - $appro;
                            $SR = $SF - $vente;
                        @endphp

                        <tr>
                            {{-- Affichage du nom de la catégorie uniquement sur la première ligne --}}
                            @if($index === 0)
                                <td rowspan="{{ $nbProduits }}"
                                    style="vertical-align: middle; background-color: #f1f5f9; font-weight: bold;">
                                    {{ $categorie->nom }}
                                </td>
                            @endif

                            <td>{{ $produit->nom }}</td>
                            <td class="amount">{{ afficherMontant($SI) }}</td>
                            <td class="amount">{{ afficherMontant($appro) }}</td>
                            <td class="amount">{{ afficherMontant($vente) }}</td>
                            <td class="amount">{{ afficherMontant($SF) }}</td>
                            <td class="amount">{{ afficherMontant($SR) }}</td>
                        </tr>
                    @endforeach
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
                @php
                    $groupes = $ventes->groupBy('paiement.nom');
                @endphp

                @foreach($groupes as $mode => $ventesParMode)
                    @php
                        $produits = $ventesParMode->groupBy('produit.nom');
                        $rowspan = $produits->count() + 1; // +1 pour le sous-total
                    @endphp

                    @php $isFirstRow = true; @endphp
                    @foreach($produits as $produitNom => $groupe)
                        <tr>
                            @if($isFirstRow)
                                <td rowspan="{{ $rowspan }}"
                                    style="vertical-align: middle; background-color: #f1f5f9; font-weight: bold;">
                                    {{ strtoupper($mode) }}
                                </td>
                                @php $isFirstRow = false; @endphp
                            @endif
                            <td>{{ $produitNom }}</td>
                            <td class="amount">{{ number_format($groupe->sum('montant_total'), 0, ',', ' ') }}</td>
                        </tr>
                    @endforeach

                    <tr class="total-row" style="font-weight: bold; background-color: #e2e8f0;">
                        <td style="text-align: right;">SOUS-TOTAL {{ strtoupper($mode) }}</td>
                        <td class="amount">{{ number_format($ventesParMode->sum('montant_total'), 0, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">Ventes par produit</h2>
        @php
            $paiements = ['Ticket Valeur', 'JNP Pass', 'Espèce'];
            $categories = ['Produits Blancs', 'Lubrifiants', 'Gaz et Accessoires']; // ordre souhaité
        @endphp

        <table>
            <thead>
                <tr>
                    <th>Produit / Catégorie</th>
                    @foreach($paiements as $mode)
                        <th class="amount">{{ $mode }}</th>
                    @endforeach
                    <th class="amount">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totauxGeneraux = array_fill_keys($paiements, 0);
                    $grandTotal = 0;
                @endphp

                {{-- Cas spécial Produits Blancs : afficher chaque produit --}}
                @foreach(['Gasoil', 'Essence'] as $produitNom)
                    @php
                        $ventesProduit = $ventes->where('produit.nom', $produitNom);
                        $parMode = $ventesProduit->groupBy('paiement.nom');

                        $totaux = [];
                        foreach ($paiements as $mode) {
                            $totaux[$mode] = isset($parMode[$mode])
                                ? $parMode[$mode]->sum('montant_total')
                                : 0;
                            $totauxGeneraux[$mode] += $totaux[$mode];
                        }
                        $totalGeneral = array_sum($totaux);
                        $grandTotal += $totalGeneral;
                    @endphp
                    <tr>
                        <td><strong>{{ $produitNom }}</strong></td>
                        @foreach($paiements as $mode)
                            <td class="amount">{{ number_format($totaux[$mode], 2, ',', ' ') ?? 'Néant' }}</td>
                        @endforeach
                        <td class="amount"><strong>{{ number_format($totalGeneral, 2, ',', ' ') ?? 'Néant'}}</strong></td>
                    </tr>
                @endforeach

                {{-- Autres catégories (somme des produits de la catégorie) --}}
                @foreach($categories as $categorieNom)
                    @if($categorieNom != 'Produits Blancs')
                        @php
                            $ventesCategorie = $ventes->filter(fn($v) => $v->produit->categorie->nom === $categorieNom);
                            $parMode = $ventesCategorie->groupBy('paiement.nom');

                            $totaux = [];
                            foreach ($paiements as $mode) {
                                $totaux[$mode] = isset($parMode[$mode])
                                    ? $parMode[$mode]->sum('montant_total')
                                    : 0;
                                $totauxGeneraux[$mode] += $totaux[$mode];
                            }

                            $totalGeneral = array_sum($totaux);
                            $grandTotal += $totalGeneral;
                        @endphp
                        <tr>
                            <td><strong>{{ $categorieNom }}</strong></td>
                            @foreach($paiements as $mode)
                                <td class="amount">{{ number_format($totaux[$mode], 2, ',', ' ') }}</td>
                            @endforeach
                            <td class="amount"><strong>{{ number_format($totalGeneral, 2, ',', ' ') }}</strong></td>
                        </tr>
                    @endif
                @endforeach

                {{-- TOTAL GÉNÉRAL --}}
                <tr class="total-row">
                    <td><strong>TOTAL GÉNÉRAL</strong></td>
                    @foreach($paiements as $mode)
                        <td class="amount"><strong>{{ number_format($totauxGeneraux[$mode], 2, ',', ' ') }}</strong></td>
                    @endforeach
                    <td class="amount"><strong>{{ number_format($grandTotal, 2, ',', ' ') }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="summary-box">
        <h3>Résumé Financier</h3>
        @php
            $totalComptant = $ventes->where('paiement.nom', 'Espèce')->sum('montant_total');
            $ticket = 1000; // à personnaliser si besoin
        @endphp
        <p><strong>Total des ventes à verser à la banque :</strong> {{ afficherMontant($totalComptant) }} F
        </p>
        <p><strong>Ticket de vente :</strong> {{ afficherMontant($ticket) }} F</p>
        <p><strong>Reste à verser :</strong> {{ afficherMontant($totalComptant - $ticket) }} F</p>
    </div>

    <div class="footer">
        <div>© StationFlow - Tous droits réservés.</div>
        <div>Rapport généré le {{ now()->format('d/m/Y à H:i') }}</div>
    </div>

</body>

</html>