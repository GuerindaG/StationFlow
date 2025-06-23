@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-8">
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
                    <div class="card-header d-block d-sm-flex border-0">
                        <div class="col-lg-7 p-6">
                        </div>
                        <div class="col-lg-5 text-end">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="lam-tab" data-bs-toggle="tab"
                                        data-bs-target="#lam-tab-pane" type="button" role="tab">Produits blancs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="#" aria-current="true" id="home-tab" data-bs-toggle="tab"
                                        data-bs-target="#home-tab-pane" type="button" role="tab">Gaz & Accessoires</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" id="profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#profile-tab-pane" type="button" role="tab">Lubrifiants</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content" id="myTabContent">
                            <div class="p-6">
                                <div class="row">
                                    <div class="col-md-12 g-3 col-12">
                                        <form method="GET" class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <input type="date" id="date_filter" name="date_filter" class="form-control"
                                                    value="{{ $date_filter }}">
                                            </div>

                                            <div class="col-auto">
                                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-filter"></i></button>
                                                <a href="{{ route('vente.index') }}" class="btn btn-secondary"><i class="fa-solid fa-power-off"></i></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show active" id="lam-tab-pane" role="tabpanel"
                                aria-labelledby="contact-tab" tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>N°</th>
                                                <th>Produits</th>
                                                <th>TV(XOF)</th>
                                                <th>JNP PASS(XOF)</th>
                                                <th>Comptant(XOF)</th>
                                                <th>Total</th>
                                                <th>Date d'enregistrement</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $ventesPB = $ventes->filter(fn($v) => $v->produit->categorie->nom === 'Produits blancs');
                                            $ventesGroupées = $ventesPB->groupBy('produit_id');
                                        @endphp
                                        <tbody>
                                            @forelse ($ventesGroupées as $index => $venteParProduit)
                                                @php
                                                    $produit = $venteParProduit->first()->produit;
                                                    $tv = $venteParProduit->where('paiement.nom', 'Ticket Valeur')->sortByDesc('created_at')->first()?->montant_total ?? 0;
                                                    $jnp = $venteParProduit->where('paiement.nom', 'JNP Pass')->sortByDesc('created_at')->first()?->montant_total ?? 0;
                                                    $comptant = $venteParProduit->where('paiement.nom', 'Espèce')->sortByDesc('created_at')->first()?->montant_total ?? 0;

                                                    $total = $tv + $jnp + $comptant;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $produit->nom}}</td>
                                                    <td>{{ number_format($tv, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($jnp, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($comptant, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($total, 0, ',', ' ') }}</td>
                                                    <td>{{ $produit->created_at }}</a></td>
                                                    <td class="text-center">
                                                        <a href="{{ route('vente.show', $produit->id) }}"
                                                            class="btn btn-sm btn-outline-primary view-details">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Aucune vente trouvée pour les produits blancs.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                                tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>N°</th>
                                                <th>Produits</th>
                                                <th>TV(XOF)</th>
                                                <th>JNP PASS(XOF)</th>
                                                <th>Comptant(XOF)</th>
                                                <th>Total</th>
                                                <th>Date d'enregistrement</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $ventesG = $ventes->filter(fn($v) => $v->produit->categorie->nom === 'Gaz et accessoires');
                                            $ventesGroupées = $ventesG->groupBy('produit_id');
                                        @endphp
                                        <tbody>
                                            @forelse ($ventesGroupées as $index => $venteParProduit)
                                                @php
                                                    $produit = $venteParProduit->first()->produit;
                                                    $tv = $venteParProduit->where('paiement.nom', 'Ticket Valeur')->sortByDesc('created_at')->first()?->montant_total ?? 0;
                                                    $jnp = $venteParProduit->where('paiement.nom', 'JNP Pass')->sortByDesc('created_at')->first()?->montant_total ?? 0;
                                                    $comptant = $venteParProduit->where('paiement.nom', 'Espèce')->sortByDesc('created_at')->first()?->montant_total ?? 0;

                                                    $total = $tv + $jnp + $comptant;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $produit->nom}}</td>
                                                    <td>{{ number_format($tv, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($jnp, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($comptant, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($total, 0, ',', ' ') }}</td>
                                                    <td>{{ $produit->created_at }}</a></td>
                                                    <td class="text-center">
                                                        <a href="{{ route('vente.show', $produit->id) }}"
                                                            class="btn btn-sm btn-outline-primary view-details">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Aucune vente trouvée pour les gaz et accessoires.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                                tabindex="0">
                                <div class="table-responsive">
                                    <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>N°</th>
                                                <th>Produits</th>
                                                <th>TV(XOF)</th>
                                                <th>JNP PASS(XOF)</th>
                                                <th>Comptant(XOF)</th>
                                                <th>Total</th>
                                                <th>Date d'enregistrement</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $ventesL = $ventes->filter(fn($v) => $v->produit->categorie->nom === 'Lubrifiants');
                                            $ventesGroupées = $ventesL->groupBy('produit_id');
                                        @endphp
                                        <tbody>
                                            @forelse ($ventesGroupées as $index => $venteParProduit)
                                                @php
                                                    $produit = $venteParProduit->first()->produit;
                                                    $tv = $venteParProduit->where('paiement.nom', 'Ticket Valeur')->sortByDesc('created_at')->first()?->montant_total ?? 0;
                                                    $jnp = $venteParProduit->where('paiement.nom', 'JNP Pass')->sortByDesc('created_at')->first()?->montant_total ?? 0;
                                                    $comptant = $venteParProduit->where('paiement.nom', 'Espèce')->sortByDesc('created_at')->first()?->montant_total ?? 0;

                                                    $total = $tv + $jnp + $comptant;
                                                @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $produit->nom}}</td>
                                                    <td>{{ number_format($tv, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($jnp, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($comptant, 0, ',', ' ') }}</td>
                                                    <td>{{ number_format($total, 0, ',', ' ') }}</td>
                                                    <td>{{ $produit->created_at }}</a></td>
                                                    <td class="text-center">
                                                        <a href="{{ route('vente.show', $produit->id) }}"
                                                            class="btn btn-sm btn-outline-primary view-details">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Aucune vente trouvée pour les Lubrifiants.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                        <span> Affichage de {{ $ventes->firstItem() }} à {{ $ventes->lastItem() }} sur
                            {{ $ventes->total() }} résultats</span>
                        <nav>
                            <ul class="pagination mb-0">
                                <!-- Previous button -->
                                <li class="page-item {{ $ventes->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $ventes->previousPageUrl() }}" tabindex="-1">Préc</a>
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

@endsection