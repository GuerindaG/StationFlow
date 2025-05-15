<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StationFlow - Liste des stations-service </title>

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


        .content {
            position: relative;
            min-height: 500px;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 100px;
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
        <div class="header" style="overflow: hidden;">
            <div style="float: left; width: 60%;">
                <img src="{{ asset(' ./assets/images/logo/stationflow-logo.svg') }}" height="60" alt="Logo">
            </div>
            <div class="doc-info" style="float: right; width: 40%; text-align: right;">
                <div style="font-weight: bold;">Liste des {{ $type }}</div>
                <div>Généré le: {{ $date }}</div>
                <div>à {{ $heure }}</div>
            </div>
        </div>

        <div class="content">
            <div class="watermark">StationFlow</div>

            <h2>Liste {{ ucfirst($type)}}</h2>
            
            <table class="content-to-export">
                <thead>
                    <tr>
                        @foreach($columns as $col)
                            <th>{{ $col }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                        <tr>
                            @foreach($columns as $col)
                                <td>{{ $item[$col] ?? '' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p>Ce rapport présente la liste complète des stations-service enregistrées dans le système StationFlow. Les
                informations sont mises à jour quotidiennement et reflètent l'état actuel du réseau.(à dynamiser)</p>
        </div>

        <div class="footer">
            <div>© 2025 StationFlow - Tous droits réservés</div>
            @if (isset($pdf))
                <script type="text">
                                        @php

                                            if (isset($pdf)) {
                                                $pdf->page_script('
                                                                                                                                        $font = $fontMetrics->get_font("Arial", "normal");
                                                                                                                                        $pdf->text(520, 820, "Page $PAGE_NUM sur $PAGE_COUNT", $font, 10);
                                                                                                                                    ');
                                            }
                                        @endphp
                            </script>
            @endif

        </div>
    </div>
</body>

</html>