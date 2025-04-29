@extends('Gerant.LayoutGerant')
@section('content-body')

    <div class="card h-100 card-lg mb-5">
        <div class="card-body">
            <div class="row p-5">
                <form role="Rechercher" class="col-lg-9">
                    <input class="form-control" type="search" placeholder="Rechercher" aria-label="Search" />
                </form>
                <div class="col-lg-3 ">
                    <button class="btn btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#product">A modifier</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
            <div class="card h-100 card-lg mb-5">
                <div class="card-header d-block d-sm-flex border-0">
                    <div class="col-lg-7 p-6">
                        <h3 class="mb-0 fs-5">Gestion des Ventes</h3>
                    </div>
                    <div class="col-lg-5 text-end">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" aria-current="true" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab">Produits blancs </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab">Gaz & Accessoires</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="lam-tab" data-bs-toggle="tab" data-bs-target="#lam-tab-pane"
                                    type="button" role="tab">Lubrifiants</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-0 ">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div class="table-responsive">
                                <table
                                    class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:80px;">#</th>
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
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="table-responsive">
                                <table
                                    class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:80px;">#</th>
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
                        <div class="tab-pane fade" id="lam-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            <div class="table-responsive">
                                <table
                                    class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:80px;">#</th>
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
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    
                                </div>
                                <nav>
                                    <ul class="pagination mb-0">
                                        <li class="page-item disabled"><a class="page-link" href="#!">Précédent</a></li>
                                        <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#!">Suivant</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('vente.create')

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

    <!-- Floating action button for adding new sales -->
    <div class="position-fixed bottom-0 end-0 p-4">
        <button class="btn btn-primary rounded-circle p-3 shadow" data-bs-toggle="modal" data-bs-target="#newSaleModal">
            <i class="fas fa-plus"></i>
        </button>
    </div>

@endsection