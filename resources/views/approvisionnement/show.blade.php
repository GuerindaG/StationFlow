@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h5>Historique des réceptions du produit : {{ $produit->nom }}</h5>
                    </div>
                    <div class="col-auto">
                        <a href="{{route('approvisionnement.index')}}" class="btn btn-secondary ">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-header d-block d-sm-flex border-0">
                        <div class="col-lg-7 p-6">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="p-6">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <form method="GET" class="mb-4">
                                        <div class="row g-6 align-items-center">
                                            <div class="col-auto">
                                                <label for="date_debut" class="col-form-label">Date de début :</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" id="date_debut" name="date_debut" class="form-control"
                                                    value="{{ request('date_debut') }}">
                                            </div>
                                            <div class="col-auto">
                                                <label for="date_fin" class="col-form-label">Date de fin :</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" id="date_fin" name="date_fin" class="form-control"
                                                    value="{{ request('date_fin') }}">
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-outline-gray-400 text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-filter me-2">
                                                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3">
                                                        </polygon>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>N°</th>
                                        <th>Quantité</th>
                                        <th>Montant</th>
                                        <th>Date de réception</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($approvisionnements as $appro)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $appro->qte_appro }}</td>
                                            <td>{{ number_format($appro->montant_total, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ \Carbon\Carbon::parse($appro->date_approvisionnement)->format('d/m/Y') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Aucun historique de livraison trouvé.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                        <span> Affichage de {{ $approvisionnements->firstItem() }} à {{ $approvisionnements->lastItem() }}
                            sur
                            {{ $approvisionnements->total() }} résultats</span>
                        <nav>
                            <ul class="pagination mb-0">
                                <!-- Previous button -->
                                <li class="page-item {{ $approvisionnements->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $approvisionnements->previousPageUrl() }}"
                                        tabindex="-1">Prec</a>
                                </li>

                                <!-- Display limited number of pages (3 pages max) -->
                                @foreach ($approvisionnements->getUrlRange(1, 3) as $page => $url)
                                    <li class="page-item {{ $page == $approvisionnements->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Next button -->
                                <li class="page-item {{ $approvisionnements->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $approvisionnements->nextPageUrl() }}">Suiv</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection