@extends('Gerant.LayoutGerant')
@section('content-body')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Ventes</h2>
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
                            <div class="tab-pane fade show active" id="lam-tab-pane" role="tabpanel"
                                aria-labelledby="contact-tab" tabindex="0">
                                <div class="p-6">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <form method="GET" action="{{ route('vente.index') }}" class="d-flex mb-3">
                                                <input class="form-control me-2" type="search" name="search"
                                                    placeholder="Rechercher " value="{{ request('search') }}"
                                                    aria-label="Search">
                                                <span class="input-group-append">
                                                    <button
                                                        class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                                        type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-search">
                                                            <circle cx="11" cy="11" r="8"></circle>
                                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ventes->filter(fn($v) => $v->produit->categorie->nom === 'Produits blancs') as $pb)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pb->produit->nom}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <a href="{{ route('vente.show', $pb->produit->id) }}"
                                                            class="btn btn-sm btn-outline-primary view-details">
                                                            <i class="fas fa-eye"></i>
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
                                <div class="p-6">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <form method="GET" action="{{ route('vente.index') }}" class="d-flex mb-3">
                                                <input class="form-control me-2" type="search" name="search"
                                                    placeholder="Rechercher un approvisionnement"
                                                    value="{{ request('search') }}" aria-label="Search">
                                                <span class="input-group-append">
                                                    <button
                                                        class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                                        type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-search">
                                                            <circle cx="11" cy="11" r="8"></circle>
                                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ventes->filter(fn($v) => $v->produit->categorie->nom === 'Gaz et accessoires') as $pb)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pb->produit->nom}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <a href="{{ route('vente.show', $pb->produit->id) }}"
                                                            class="btn btn-sm btn-outline-primary view-details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Aucune vente trouvée pour les Gaz et accessoires.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                                tabindex="0">
                                <div class="p-6">
                                    <div class="row">
                                        <div class="col-md-4 col-12">
                                            <form method="GET" action="{{ route('vente.index') }}" class="d-flex mb-3">
                                                <input class="form-control me-2" type="search" name="search"
                                                    placeholder="Rechercher une categorie" value="{{ request('search') }}"
                                                    aria-label="Search">
                                                <span class="input-group-append">
                                                    <button
                                                        class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                                        type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                            class="feather feather-search">
                                                            <circle cx="11" cy="11" r="8"></circle>
                                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                        </svg>
                                                    </button>
                                                </span>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ventes->filter(fn($v) => $v->produit->categorie->nom === 'Lubrifiants') as $pb)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $pb->produit->nom}}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <a href="{{ route('vente.show', $pb->produit->id) }}"
                                                            class="btn btn-sm btn-outline-primary view-details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Aucune vente trouvée pour les lubrifiants.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                        <span>Showing 1 to 8 of 12 entries</span>
                        <nav class="mt-2 mt-md-0">
                            <ul class="pagination mb-0">
                                <li class="page-item disabled"><a class="page-link" href="#!">Previous</a></li>
                                <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                                <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                <li class="page-item"><a class="page-link" href="#!">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection