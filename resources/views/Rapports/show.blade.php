@extends('Gerant.LayoutGerant')

@section('content-body')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <h2 class="mb-0">
                        Rapports du mois de
                        {{ \Carbon\Carbon::parse($mois . '-01')->locale('fr')->translatedFormat('F Y') }}
                    </h2>
                    <a href="{{ route('rapports.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left me-1"></i> Retour
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-body p-0">
                        <div class="p-6">
                            <div class="row mb-4">
                                <div class="col-xl-12 col-12">
                                    <form method="GET" class="row g-3 align-items-center">
                                        <div class="col-auto">
                                            <input type="date" id="date_filter" name="date_filter" class="form-control"
                                                value="{{ request('date_filter') }}">
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-outline-gray-400 text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-filter me-2">
                                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3">
                                                    </polygon>
                                                </svg>
                                            </button>
                                            <a href="{{ route('fichier.pdf', ['mois' => $mois]) }}"
                                                class="btn btn-btn btn-outline-gray-400 text-muted">
                                                <i class="fa-solid fa-refresh"></i>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                                @forelse($fichiers as $fichier)
                                    <div class="col">
                                        <div class="card card-product"
                                            ondblclick="window.open('{{ $fichier['lien'] }}', '_blank')">
                                            <div class="card-body">
                                                <div class="text-center position-relative">
                                                    <i class="fa-solid fa-file-lines fa-5x text-grey"></i>
                                                </div>
                                                <div class="text-small mb-1 p-4">
                                                    <h2 class="fs-6 text-center">{{ $fichier['nom'] }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12">
                                        <div class="alert alert-info text-center">Aucun fichier trouvé pour ce mois.</div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection