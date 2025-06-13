<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste catégories - StationFlow</title>
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
            <div class="report-info">
                <h1><strong>
                        <center>LISTE DES CATEGORIES</center>
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
                            <th>Désignation</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $categorie)
                            <tr>
                                <td> {{ $loop->iteration }}</td>
                                <td>{{ $categorie->nom }}</td>
                                <td><small>{{ $categorie->description }}</small></td>
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
            </div>
        </div>
    </div>
</body>

</html>