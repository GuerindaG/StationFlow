<!-- Javascript -->
<script src="{{ asset('assets/libs/nouislider/dist/nouislider.min.js') }}"></script>
<script src="{{ asset('assets/libs/wnumb/wNumb.min.js') }}"></script>

<!-- Libs JS -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- Theme JS -->
<script src="{{ asset('assets/js/theme.min.js') }}"></script>

<!-- Autres bibliothèques JS -->
<script src="{{ asset('assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/js/vendors/tns-slider.js') }}"></script>
<script src="{{ asset('assets/js/vendors/zoom.js') }}"></script>
<script src="{{ asset('.assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/chart.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Repeater -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

<!-- Affichage de la date et de l'heure actuelles dans le pied de page -->
<script>
    document.getElementById('generated-date').innerText = new Date().toLocaleString();
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: '{{ session('error') }}',
            confirmButtonColor: '#d33',
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Erreur(s) de validation',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
        });
    @endif
</script>

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