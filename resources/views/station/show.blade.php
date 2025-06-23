@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="row mb-12">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h2>Historique des raports : {{ $station->nom }} </h2>
                </div>
                <div>
                    <form method="GET" class="row g-3 align-items-center">
                        <div class="col-auto">
                            <input type="date" id="date_filter" name="date_filter" class="form-control" value="">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-filter"></i></button>
                            <a href="{{ route('voirRapport', $station->id) }}" class="btn btn-light"><i
                                    class="fa-solid fa-power-off"></i></a>
                        </div>
                    </form>
                </div>
            </div>
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
                        <a href="{{ route('voirRapport', $station->id) }}" class="btn-action mb-2">
                            <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="voir"></i>
                        </a>
                        <!--Route affichant les pdf du mois de février pour cette station-->
                        <a href="{{ asset('rapports/station_1/Juin_2025.zip') }}" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                            title="Télécharger tous les rapports - Février 2025"><i class="bi bi-download"></i>
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
                        <a href="" class="btn-action mb-2">
                            <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true" title="voir"></i>
                        </a>
                        <a href="{{ asset('rapports/station_1/Juin_2025.zip') }}" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                            title="Télécharger tous les rapports - Février 2025"><i class="bi bi-download"></i>
                        </a>
                    </div>
                    <div class="text-small mb-1 p-4">
                        <h2 class="fs-6 text-center">Février-2025</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection