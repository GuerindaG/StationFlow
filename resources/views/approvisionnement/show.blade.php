@extends('Gerant.LayoutGerant')
@section('content-body')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Historique des réceptions du produit : {{ $produit->nom }}</h2>
                    </div>
                    <div>
                        <a href="{{route('approvisionnement.index')}}" class="btn btn-light">Retour</a>
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
                                                <button type="submit" class="btn btn-primary">Filtrer</button>
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
                                    @if ($approvisionnements->isEmpty())
                                        <tr>
                                            <td colspan="4">Aucun historique de livraison trouvé.</td>
                                        </tr>
                                    @else
                                        @foreach($approvisionnements as $appro)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $appro->qte_appro }}</td>
                                                <td>{{ number_format($appro->montant_total, 0, ',', ' ') }} FCFA</td>
                                                <td>{{ \Carbon\Carbon::parse($appro->date_approvisionnement)->format('d/m/Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                        <span>Showing 1 to 8 of 12 entries</span>
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