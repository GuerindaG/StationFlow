@extends('Gerant.LayoutGerant')

@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Géneration des rapports</h2>
                    </div>
                    <div>
                        <a href="{{ route('generer.pdf') }}" class="btn btn-primary active mb-2" target="_blank">
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </a>
                        <form action="{{ route('rapport.journalier.sauvegarder', ['station' => $station->id]) }}"
                            method="POST">
                            @csrf
                            
                                <button type="submit" class="btn btn-dark">
                                    <i class="bi bi-save"></i>
                                </button>
                           
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- PAGE D'AFIICHAGE DES DOSSIERS MENSUEL -->
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-body p-0">
                        <div class="p-6">
                            <!-- Filtres PoUR SELECTIONNER ET AFFICHER LES MOIS PAR ANN2E-->
                            <div class="row mb-4">
                                <div class="col-xl-12 col-12">
                                    <form method="GET" class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <input type="date" id="date_filter" name="date_filter" class="form-control"
                                                value="">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa-solid fa-filter"></i></button>
                                            <a href="{{ route('vente.index') }}" class="btn btn-secondary"><i
                                                    class="fa-solid fa-power-off"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative">
                                                <i class="fa-solid fa-folder fa-5x text-muted"></i>
                                            </div>
                                            <div class="product-action-btn">
                                                <a href="{{ route('fichier.pdf') }}" class="btn-action mb-2">
                                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="voir"></i>
                                                </a>
                                                <a href="{{ route('rapports.mensuel.zip', ['stationId' => $station->id, 'mois' => '2025-06']) }}"
                                                    class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                                    title="Télécharger tous les rapports - Février 2025"><i
                                                        class="bi bi-download"></i>
                                                </a>
                                            </div>
                                            <div class="text-small mb-1 p-4">
                                                <h2 class="fs-6 text-center">Janvier-2025</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card card-product">
                                        <div class="card-body">
                                            <div class="text-center position-relative">
                                                <i class="fa-solid fa-folder fa-5x text-muted"></i>
                                            </div>
                                            <div class="product-action-btn">
                                                <a href="{{ route('fichier.pdf') }}" class="btn-action mb-2">
                                                    <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                                        title="voir"></i>
                                                </a>
                                                <a href="{{ asset('rapports/station_1/Juin_2025.zip') }}" class="btn-action"
                                                    data-bs-toggle="tooltip" data-bs-html="true"
                                                    title="Télécharger tous les rapports - Février 2025"><i
                                                        class="bi bi-download"></i>
                                                </a>
                                            </div>
                                            <div class="text-small mb-1 p-4">
                                                <h2 class="fs-6 text-center">Février-2025</h2>
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
    </div>
@endsection