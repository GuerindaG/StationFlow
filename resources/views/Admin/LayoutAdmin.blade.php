<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>StationFlow - Administration</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('./assets/images/favicon/stationflow-favicon.svg')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @include('admin.css')
</head>

<body>
    <div class="border-bottom">
        @include('admin.header')
        @include('admin.navbar')
    </div>
    <main>
        <div class="mt-8 mb-lg-14 mb-8">
            <div class="container">
                <div class="row gx-10"></div>
                @yield('content-body')
            </div>
        </div>
    </main>
    @include('admin.footer')
    @include('admin.js')
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
</body>

</html>