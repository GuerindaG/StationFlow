<script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "G-M8S4MT3EYG");
</script>
<script type="text/javascript">
    (function (c, l, a, r, i, t, y) {
        c[a] =
            c[a] ||
            function () {
                (c[a].q = c[a].q || []).push(arguments);
            };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "kuc8w5o9nt");
</script>

<script src="../assets/js/vendors/validation.js"></script>
<!-- Javascript-->
<script src="../assets/libs/nouislider/dist/nouislider.min.js"></script>
<script src="../assets/libs/wnumb/wNumb.min.js"></script>
<!-- Libs JS -->
<!-- <script src="../assets/libs/jquery/dist/jquery.min.js"></script> -->
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>


<!-- Theme JS -->
<script src="../assets/js/theme.min.js"></script>

<script src="../assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
<script src="../assets/js/vendors/tns-slider.js"></script>
<script src="../assets/js/vendors/zoom.js"></script>


<!-- <script src="{{ asset('../assets/libs/jquery/dist/jquery.min.js')}}"></script> -->
<script src="{{ asset('./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('./assets/libs/simplebar/dist/simplebar.min.js')}}"></script>
<script src="{{ asset('./assets/js/theme.min.js')}}"></script>
<script src="{{ asset('./assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{ asset('./assets/js/vendors/chart.js')}}"></script>

<script>
    // Afficher la date et l'heure actuelles dans le pied de page
    document.getElementById('generated-date').innerText = new Date().toLocaleString();
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#categorie_id').on('change', function () {
        var categorieId = $(this).val();
        if (categorieId) {
            $.ajax({
                url: '/get-produits/' + categorieId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#produit_id').empty(); // Vide la liste actuelle
                    $('#produit_id').append('<option value="">Sélectionnez un produit</option>');
                    $.each(data, function (key, produit) {
                        $('#produit_id').append('<option value="' + produit.id + '">' + produit.nom + '</option>');
                    });
                }
            });
        } else {
            $('#produit_id').empty().append('<option value="">Sélectionnez une catégorie d\'abord</option>');
        }
    });
</script>