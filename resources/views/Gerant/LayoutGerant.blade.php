<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="StationFlow - Gestion" name="author">
    <title></title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon/stationflow-favicon.svg')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @include('Gerant.css')
</head>

<body>
    @include('Gerant.navbar')
    <div class="main-wrapper">
        @include('Gerant.verticalNav')
        <main class="main-content-wrapper">
            @yield('content-body')
        </main>
    </div>
    @include('Gerant.js')

    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        @endif
    </script>

    <script>
        $(document).ready(function () {
            let rowIndex = 1;

            $('#addRow').on('click', function () {
                let newRow = `<tr>
                <td>
                    <select name="ventes[${rowIndex}][categorie_id]" class="form-control categorie-select">
                        <option value="">Choisir</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="ventes[${rowIndex}][produit_id]" class="form-control produit-select">
                        <option value="">--</option>
                    </select>
                </td>
                <td><input type="number" name="ventes[${rowIndex}][quantite]" class="form-control"></td>
                <td>
                    <select name="ventes[${rowIndex}][paiement_id]" class="form-control">
                        <option value="">Choisir</option>
                        @foreach($paiements as $paiement)
                            <option value="{{ $paiement->id }}">{{ $paiement->nom }}</option>
                        @endforeach
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger removeRow">X</button></td>
            </tr>`;
                $('#venteTable tbody').append(newRow);
                rowIndex++;
            });

            // ❌ Supprimer une ligne
            $(document).on('click', '.removeRow', function () {
                $(this).closest('tr').remove();
            });

            // 🔄 Changement de catégorie (ligne dynamique)
            $(document).on('change', '.categorie-select', function () {
                const row = $(this).closest('tr');
                const categorieId = $(this).val();
                const produitSelect = row.find('.produit-select');

                if (categorieId) {
                    $.ajax({
                        url: `/get-produits/${categorieId}`,
                        method: 'GET',
                        success: function (data) {
                            produitSelect.empty().append('<option value="">Choisir</option>');
                            data.forEach(function (produit) {
                                produitSelect.append(`<option value="${produit.id}">${produit.nom}</option>`);
                            });
                        },
                        error: function () {
                            alert("Erreur lors du chargement des produits.");
                        }
                    });
                } else {
                    produitSelect.empty().append('<option value="">Choisir une catégorie</option>');
                }
            });

            // 🔁 Pour un formulaire simple hors tableau (si utilisé)
            $('#categorie_id').on('change', function () {
                var categorieId = $(this).val();
                var produitSelect = $('#produit_id');

                if (categorieId) {
                    $.ajax({
                        url: '/get-produits/' + categorieId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            produitSelect.empty().append('<option value="">Sélectionnez un produit</option>');
                            $.each(data, function (key, produit) {
                                produitSelect.append('<option value="' + produit.id + '">' + produit.nom + '</option>');
                            });
                        },
                        error: function () {
                            alert("Erreur lors du chargement des produits.");
                        }
                    });
                } else {
                    produitSelect.empty().append('<option value="">Sélectionnez une catégorie d\'abord</option>');
                }
            });
        });
    </script>
</body>

</html>