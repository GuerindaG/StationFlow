@extends('Gerant.LayoutGerant')

@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2 class="mb-0 fs-1">Rapports de {{ $monthYear }}</h2>
                    </div>
                    <div>
                        <a href="{{ route('rapports.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-body p-0">
                        <div class="p-6">
                            <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                                @forelse($rapports as $rapport)
                                    <div class="col">
                                        <a href="{{ route('rapports.show', $rapport) }}" class="text-decoration-none">
                                            <div class="card card-product report-card">
                                                <div class="card-body">
                                                    <div class="text-center position-relative">
                                                        <i class="fa-solid fa-file-lines fa-4x text-primary"></i>
                                                        @if($rapport->type === 'quotidien')
                                                            <span
                                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                                Quotidien
                                                            </span>
                                                        @else
                                                            <span
                                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info">
                                                                Synthèse
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="text-center mt-3">
                                                        <h5 class="mb-1">Rapport #{{ $rapport->id }}</h5>
                                                        <small
                                                            class="text-muted">{{ $rapport->created_at->format('d/m/Y H:i') }}</small>
                                                        <div class="mt-2">
                                                            @if($rapport->vente)
                                                                <span class="badge bg-success me-1">
                                                                    {{ $rapport->vente->count() }} vente(s)
                                                                </span>
                                                            @endif
                                                            @if($rapport->approvisionnement)
                                                                <span class="badge bg-warning">
                                                                    {{ $rapport->approvisionnement->count() }} approv.
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <i class="fa-solid fa-file-circle-xmark fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucun rapport disponible pour ce mois</p>
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