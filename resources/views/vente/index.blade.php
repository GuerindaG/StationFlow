@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Gestion des ventes</h2>
                    </div>
                    <div>
                        <a href="{{ route('vente.create') }}" class="btn btn-primary">Nouvelle vente</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-body p-0">
                        <div class="tab-content" id="myTabContent">
                            <div class="p-6">
                                <div class="row">
                                    <div class="col-md-12 g-3 col-12">
                                        <form method="GET" class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <select name="categorie_filter" id="categorie_filter" class="form-select">
                                                    <option value="">Toutes catégories</option>
                                                    @foreach($categories as $categorie)
                                                        <option value="{{ $categorie->id }}" {{ request('categorie_filter') == $categorie->id ? 'selected' : '' }}>
                                                            {{ $categorie->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" id="date_filter" name="date_filter" class="form-control"
                                                    value="{{ $date_filter }}">
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
                                                <a href="{{ route('vente.index') }}"
                                                    class="btn btn-btn btn-outline-gray-400 text-muted">
                                                    <i class="fa-solid fa-refresh"></i>
                                                </a>
                                                <a href="{{ route('vente.download', ['format' => 'pdf', 'date_filter' => $date_filter]) }}" target="_blank" class="btn btn-dark">
                                                    <i class="bi bi-download"></i>
                                                </a><!-- Bouton Csv -->
                                                <a href="{{ route('vente.download', ['format' => 'csv', 'date_filter' => $date_filter]) }}" target="_blank" class="btn btn-primary">
                                                    <i class="fas fa-file-excel mr-2"></i>
                                                </a>
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
                                            <th>Produit</th>
                                            <th class="text-end">Quantité</th>
                                            <th class="text-end">Prix Unitaire(XOF)</th>
                                            <th class="text-end">Ticket Valeur(XOF)</th>
                                            <th class="text-end">JNP Pass(XOF)</th>
                                            <th class="text-end">Espèces(XOF)</th>
                                            <th class="text-end">Total(XOF)</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $grandTotal = 0;
                                            $totalTV = 0;
                                            $totalJNP = 0;
                                            $totalEspeces = 0;
                                        @endphp

                                        @forelse ($ventes->groupBy('produit_id') as $produitId => $ventesProduit)
                                            @php
                                                $produit = $ventesProduit->first()->produit;

                                                $quantiteTotale = $ventesProduit->sum('quantite');
                                                $prixMoyen = $ventesProduit->avg('prix_unitaire');

                                                $tv = $ventesProduit->where('paiement.nom', 'Ticket Valeur');
                                                $montantTV = $tv->sum('montant_total');
                                                $quantiteTV = $tv->sum('quantite');
                                                $totalTV += $montantTV;

                                                $jnp = $ventesProduit->where('paiement.nom', 'JNP Pass');
                                                $montantJNP = $jnp->sum('montant_total');
                                                $quantiteJNP = $jnp->sum('quantite');
                                                $totalJNP += $montantJNP;

                                                $especes = $ventesProduit->where('paiement.nom', 'Espèce');
                                                $montantEspeces = $especes->sum('montant_total');
                                                $quantiteEspeces = $especes->sum('quantite');
                                                $totalEspeces += $montantEspeces;

                                                $totalProduit = $montantTV + $montantJNP + $montantEspeces;
                                                $grandTotal += $totalProduit;
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <h6 class="mb-0">{{ $produit->nom }}</h6>
                                                            <small
                                                                class="text-muted">{{ $produit->categorie->nom ?? 'N/A' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-end">{{ number_format($quantiteTotale, 0, ',', ' ') }}</td>
                                                <td class="text-end">{{ number_format($prixMoyen, 0, ',', ' ') }} </td>
                                                <td class="text-end">
                                                    <div>{{ number_format($montantTV, 0, ',', ' ') }} </div>
                                                    <small class="text-muted">{{ $quantiteTV }} ventes</small>
                                                </td>
                                                <td class="text-end">
                                                    <div>{{ number_format($montantJNP, 0, ',', ' ') }} </div>
                                                    <small class="text-muted">{{ $quantiteJNP }} ventes</small>
                                                </td>
                                                <td class="text-end">
                                                    <div>{{ number_format($montantEspeces, 0, ',', ' ') }} </div>
                                                    <small class="text-muted">{{ $quantiteEspeces }} ventes</small>
                                                </td>
                                                <td class="text-end fw-bold">{{ number_format($totalProduit, 0, ',', ' ') }}
                                                </td>
                                                <td>{{ $ventesProduit->first()->created_at->format('d/m/Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="11" class="text-center py-4">Aucune vente trouvée pour les critères
                                                    sélectionnés.</td>
                                            </tr>
                                        @endforelse

                                        @if($ventes->isNotEmpty())
                                            <tr class="table-active fw-bold">
                                                <td colspan="4">Total général</td>
                                                <td class="text-end">{{ number_format($totalTV, 0, ',', ' ') }} </td>
                                                <td class="text-end">{{ number_format($totalJNP, 0, ',', ' ') }} </td>
                                                <td class="text-end">{{ number_format($totalEspeces, 0, ',', ' ') }} </td>
                                                <td class="text-end">{{ number_format($grandTotal, 0, ',', ' ') }} </td>
                                                <td colspan="2"></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                <span>Affichage de {{ $ventes->firstItem() }} à {{ $ventes->lastItem() }} sur
                                    {{ $ventes->total() }} résultats</span>
                                <nav>
                                    {{ $ventes->appends(request()->query())->links() }}
                                </nav>
                                <nav>
                                    <ul class="pagination mb-0">
                                        <!-- Previous button -->
                                        <li class="page-item {{ $ventes->onFirstPage() ? 'disabled' : '' }}">
                                            <a class="page-link" href="{{ $ventes->previousPageUrl() }}"
                                                tabindex="-1">Préc</a>
                                        </li>

                                        <!-- Display limited number of pages (3 pages max) -->
                                        @foreach ($ventes->getUrlRange(1, 3) as $page => $url)
                                            <li class="page-item {{ $page == $ventes->currentPage() ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        <!-- Next button -->
                                        <li class="page-item {{ $ventes->hasMorePages() ? '' : 'disabled' }}">
                                            <a class="page-link" href="{{ $ventes->nextPageUrl() }}">Suiv</a>
                                        </li>
                                    </ul>
                                </nav>
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