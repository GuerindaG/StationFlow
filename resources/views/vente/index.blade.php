@extends('Gerant.LayoutGerant')
@section('content-body')

    <div class="card h-100 card-lg mb-5">
        <div class="card-body">
            <div class="row p-5">
                <form role="Rechercher" class="col-lg-9">
                    <input class="form-control" type="search" placeholder="Rechercher" aria-label="Search" />
                </form>
                <div class="col-lg-3 ">
                    <button class="btn btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#product">Nouvelle
                        vente</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
            <div class="card h-100 card-lg mb-5">
                <div class="card-header d-block d-sm-flex border-0">
                    <div class="col-lg-9 p-6">
                        <h3 class="mb-0 fs-5">Gestion des Ventes</h3>
                    </div>
                    <div class="col-g-3 text-end">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#" aria-current="true" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab">TV</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab">JNP Pass</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="lam-tab" data-bs-toggle="tab" data-bs-target="#lam-tab-pane"
                                    type="button" role="tab">Comptant</a>
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
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Designation</strong></th>
                                            <th><strong>Quantité</strong></th>
                                            <th><strong>Prix Unitaire</strong></th>
                                            <th><strong>Prix Total</strong></th>
                                            <th><strong>Historique</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Product Name</td>
                                            <td>NanNan</td>
                                            <td>NanNanXOF</td>
                                            <td>NanNanXOF</td>
                                            <td><span class="badge border-warning border-1 text-warning"
                                                    data-bs-toggle="modal" data-bs-target="#orders">00/00/20##</span></td>
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
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Designation</strong></th>
                                            <th><strong>Quantité</strong></th>
                                            <th><strong>Prix Unitaire</strong></th>
                                            <th><strong>Prix Total</strong></th>
                                            <th><strong>Historique</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Product Name</td>
                                            <td>NanNan</td>
                                            <td>NanNanXOF</td>
                                            <td>NanNanXOF</td>
                                            <td><span class="badge border-warning border-1 text-warning"
                                                    data-bs-toggle="modal" data-bs-target="#orders">00/00/20##</span></td>
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
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Designation</strong></th>
                                            <th><strong>Quantité</strong></th>
                                            <th><strong>Prix Unitaire</strong></th>
                                            <th><strong>Prix Total</strong></th>
                                            <th><strong>Historique</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>COMPARER A rapport</td>
                                            <td>NanNan</td>
                                            <td>NanNanXOF</td>
                                            <td>NanNanXOF</td>
                                            <td><span class="badge border-warning border-1 text-warning"
                                                    data-bs-toggle="modal" data-bs-target="#orders">00/00/20##</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('vente.create')

    <div class="modal fade" id="bilan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">Historique des bilans de vente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                            <thead class="table-light">
                                <tr class="text-center">

                                    <th>#</th>
                                    <th>Catégorie </th>
                                    <th>Vente en TV</th>
                                    <th>Vente en JNP PASS</th>
                                    <th>Vente au Comptant</th>
                                    <th>Dates</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <th scope="row">1</th>
                                    <td class="bg-white">Produits Blancs</td>
                                    <td><span class="badge bg-info text-dark"><i class="bi bi-info-circle me-1"></i>0000 XOF
                                        </span></td>
                                    <td>0000 XOF</td>
                                    <td>0000 XOF</td>
                                    <td>00/00/20##</td>
                                    <td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">Details Catégorie mais pas pour lubrifiants</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Produits</th>
                                    <th>Vente total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <th scope="row">1</th>
                                    <td>qsdfgh</td>
                                    <td>0000 XOF</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection