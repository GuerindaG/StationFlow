@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="row mb-12">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2> {{ $station->nom }}: Rapports
                    {{ \Carbon\Carbon::parse($mois . '-01')->locale('fr')->translatedFormat('F Y') }}
                </h2>

                <div>
                    <form method="GET" class="row g-3 align-items-center">
                        <div class="col-auto">
                            <input type="date" id="date_filter" name="date_filter" class="form-control"
                                value="{{ request('date_filter') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-outline-gray-400 text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-filter me-2">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3">
                                    </polygon>
                                </svg>
                            </button>
                            <a href="{{ route('station.rapports.mois', ['station' => $station->id, 'mois' => $mois]) }}"
                                class="btn btn-outline-gray-400 text-muted">
                                <i class="fa-solid fa-refresh"></i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('station.rapports', $station->id) }}" class="btn btn-secondary ">
                                <i class="bi bi-arrow-left"></i>
                            </a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
        @forelse($fichiers as $fichier)
            <div class="col">
                <div class="card card-product" ondblclick="window.open('{{ $fichier['lien'] }}', '_blank')">
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

@endsection