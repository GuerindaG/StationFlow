@extends('Gerant.LayoutGerant')
@section('content-body')
    @include('vente.create')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Ventes</h2>
                    </div>
                    <div>
                        <a href="add-category.html" data-bs-toggle="modal" data-bs-target="#newSaleModal"
                            class="btn btn-primary">Nouvelle vente</a>
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
                                                <th>Vente en TV</th>
                                                <th>Vente en JNP PASS</th>
                                                <th>Vente au Comptant</th>
                                                <th>Total</th>
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ventes as $approvisionnement)
                                                <tr>
                                                    <td>1</td>
                                                    <td>Essence</td>
                                                    <td>165,000 XOF</td>
                                                    <td>125,000 XOF</td>
                                                    <td>50,000 XOF</td>
                                                    <td>340,000 XOF</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('vente    .index') }}"
                                                            class="btn btn-sm btn-outline-primary view-details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Aucun approvisionnement trouvé.</td>
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
                                                <th></th>
                                                <th>Produits</th>
                                                <th>Vente en TV</th>
                                                <th>Vente en JNP PASS</th>
                                                <th>Vente au Comptant</th>
                                                <th>Total</th>
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Essence</td>
                                                <td>165,000 XOF</td>
                                                <td>125,000 XOF</td>
                                                <td>50,000 XOF</td>
                                                <td>340,000 XOF</td>
                                                <td class="text-center">
                                                    <a href="{{ route('vente.index') }}"
                                                        class="btn btn-sm btn-outline-primary view-details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
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
                                                <th>Vente en TV</th>
                                                <th>Vente en JNP PASS</th>
                                                <th>Vente au Comptant</th>
                                                <th>Total</th>
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Essence</td>
                                                <td>165,000 XOF</td>
                                                <td>125,000 XOF</td>
                                                <td>50,000 XOF</td>
                                                <td>340,000 XOF</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-primary view-details"
                                                        data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                        data-category="produits-blancs">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
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

    <!-- Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Historique du produit: <span>productname</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width:80px;">#</th>
                                    <th>Vente en TV</th>
                                    <th>Vente en JNP PASS</th>
                                    <th>Vente au Comptant</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>165,000 XOF</td>
                                    <td>125,000 XOF</td>
                                    <td>50,000 XOF</td>
                                    <td>340,000 XOF</td>
                                    <td>28/04/2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div>

                        </div>
                        <nav aria-label="Pagination TV">
                            <ul class="pagination pagination-sm" id="tv-pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Précédent</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

@endsection