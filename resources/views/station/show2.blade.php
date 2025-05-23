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
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i></button>
                            <a href="{{ route('vente.index') }}" class="btn btn-light"><i
                                    class="fa-solid fa-power-off"></i></a>
                        </div>
                    </form>
                </div>
                <div>
                    <a href="{{ route('station.show', $station->id) }}" class="btn btn-primary btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-list-task" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                            <path
                                d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                            <path fill-rule="evenodd"
                                d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                        </svg>
                    </a>
                    <a href="{{ route('voirRapport', $station->id) }}" class="btn btn-light btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                            class="bi bi-grid" viewBox="0 0 16 16">
                            <path
                                d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zM2.5 2a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zM1 10.5A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3zm6.5.5A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3zm1.5-.5a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z" />
                        </svg>
                    </a>
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
                    <div class="text-small mb-1 p-4">
                        <h2 class="fs-6 text-center"><a href="{{ route('rapport-pdf') }}"
                                class="text-inherit text-decoration-none">Janvier</a></h2>
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
                    <div class="text-small mb-1 p-4">
                        <h2 class="fs-6 text-center"><a href="{{ route('rapport-pdf') }}"
                                class="text-inherit text-decoration-none">Fevrier</a></h2>
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
                    <div class="text-small mb-1 p-4">
                        <h2 class="fs-6 text-center"><a href="{{ route('rapport-pdf') }}"
                                class="text-inherit text-decoration-none">R/Mois</a></h2>
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
                    <div class="text-small mb-1 p-4">
                        <h2 class="fs-6 text-center"><a href="{{ route('rapport-pdf') }}"
                                class="text-inherit text-decoration-none">R/Mois</a></h2>
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
                    <div class="text-small mb-1 p-4">
                        <h2 class="fs-6 text-center"><a href="{{ route('rapport-pdf') }}"
                                class="text-inherit text-decoration-none">R/Mois</a></h2>
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
@endsection