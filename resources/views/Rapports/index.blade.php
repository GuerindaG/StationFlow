@extends('Gerant.LayoutGerant')

@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Historique des rapports</h2>
                    </div>
                    <div>
                        <a href="{{ route('rapport.pdf') }}" class="btn btn-primary">
                            <i class="fa-solid fa-file-circle-plus"></i> Générer rapport
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="row mb-4">
            <div class="col-xl-12 col-12">

                <form method="GET" class="row g-3 align-items-center">
                    <div class="col-auto">
                        <input type="date" id="date_filter" name="date_filter" class="form-control" value="">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i></button>
                        <a href="{{ route('vente.index') }}" class="btn btn-light"><i class="fa-solid fa-power-off"></i></a>
                    </div>
                </form>

            </div>
        </div>

        <!-- Contenu principal -->
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-body p-0">
                        <div class="p-6">
                            <div class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative">
                                                <i class="fa-solid fa-file-lines fa-5x text-muted"></i>
                                            </div>
                                            <div class="text-small mb-1 p-4">
                                                <h2 class="fs-6 text-center"><a href="{{ route('rapport.pdf') }}"
                                                        class="text-inherit text-decoration-none">R/N°#-01-05-2025</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative">
                                                <i class="fa-solid fa-file-lines fa-5x text-muted"></i>
                                            </div>
                                            <div class="text-small mb-1 p-4">
                                                <h2 class="fs-6 text-center"><a href="{{ route('rapport.pdf') }}"
                                                        class="text-inherit text-decoration-none">R/N°#-01-05-2025</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative">
                                                <i class="fa-solid fa-file-lines fa-5x text-muted"></i>
                                            </div>
                                            <div class="text-small mb-1 p-4">
                                                <h2 class="fs-6 text-center"><a href="{{ route('rapport.pdf') }}"
                                                        class="text-inherit text-decoration-none">R/N°#-01-05-2025</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative">
                                                <i class="fa-solid fa-file-lines fa-5x text-muted"></i>
                                            </div>
                                            <div class="text-small mb-1 p-4">
                                                <h2 class="fs-6 text-center"><a href="{{ route('rapport.pdf') }}"
                                                        class="text-inherit text-decoration-none">R/N°#-01-05-2025</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative">
                                                <i class="fa-solid fa-file-lines fa-5x text-muted"></i>
                                            </div>
                                            <div class="text-small mb-1 p-4">
                                                <h2 class="fs-6 text-center"><a href="{{ route('rapport.pdf') }}"
                                                        class="text-inherit text-decoration-none">R/N°#-01-05-2025</a></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-8 text-center">
            <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                <span></span>
                <nav class="mt-2 mt-md-0">
                    <ul class="pagination mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#!">Précédent</a></li>
                        <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                        <li class="page-item"><a class="page-link" href="#!">Suivant</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection