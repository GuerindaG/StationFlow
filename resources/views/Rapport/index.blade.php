@extends('Gerant.LayoutGerant')

@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2 class="mb-0 fs-1">Historique des rapports</h2>
                    </div>
                    <div>
                        <a href="{{ route('rapports.generate.daily') }}" class="btn btn-primary">
                            <i class="fa-solid fa-file-circle-plus"></i> Générer rapport journalier
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="row mb-4">
            <div class="col-xl-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('rapports.index') }}" class="row g-3 align-items-center">
                            <div class="col-md-3">
                                <select class="form-select" name="year">
                                    @for($i = now()->year; $i >= 2020; $i--)
                                        <option value="{{ $i }}" {{ $selectedYear == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" name="month">
                                    <option value="">Tous les mois</option>
                                    @foreach(range(1, 12) as $month)
                                        <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $month)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-filter"></i> Filtrer
                                </button>
                                <a href="{{ route('rapports.index') }}" class="btn btn-light">
                                    <i class="fa-solid fa-power-off"></i> Réinitialiser
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-body p-0">
                        <div class="p-6">
                            <div class="row g-4 row-cols-xl-5 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                                @forelse($groupedReports as $month => $rapports)
                                    <div class="col">
                                        <a href="{{ route('rapports.month', $month) }}" class="text-decoration-none">
                                            <div class="card card-product folder-card">
                                                <div class="card-body">
                                                    <div class="text-center position-relative">
                                                        <i class="fa-solid fa-folder fa-5x text-warning"></i>
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                                                            {{ $rapports->count() }}
                                                        </span>
                                                    </div>
                                                    <div class="text-center mt-3">
                                                        <h5 class="mb-1">{{ $month }}</h5>
                                                        <small class="text-muted">{{ $rapports->count() }} rapport(s)</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                    <div class="col-12 text-center py-5">
                                        <i class="fa-solid fa-folder-open fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">Aucun rapport disponible</p>
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