@extends('Gerant.LayoutGerant')
@section('content-body')
    <?php
    use App\Models\Approvisionnement;
                        ?>

    <div class="card h-100 card-lg mb-5">
        <div class="card-body">
            <div class="row p-5">
                <form role="Rechercher" class="col-lg-9">
                    <input class="form-control" type="search" placeholder="Rechercher" aria-label="Search" />
                </form>
                <div class="col-lg-3 ">
                    <button class="btn btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#stock">Nouvelle
                        Livraison</button>@include('approvisionnement.create')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
            <div class="card h-100 card-lg mb-5">
                <div class="card-header d-block d-sm-flex border-0">
                    <div class="col-lg-9 p-6">
                        <h3 class="mb-0 fs-5">Liste des approvisionnements</h3>
                    </div>
                    <div class="col-lg-3 text-end">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="lam-tab" data-bs-toggle="tab" data-bs-target="#lam-tab-pane"
                                    type="button" role="tab">Livraisons</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#" aria-current="true" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab">Entrées</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab">Sorties</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="card-body p-0 ">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="lam-tab-pane" role="tabpanel"
                            aria-labelledby="contact-tab" tabindex="0">
                            <div class="table-responsive">
                                <table
                                    class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                                    <thead class="bg-light text-center">
                                        <tr>
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Produits</strong></th>
                                            <th><strong>Quantité</strong></th>
                                            <th><strong>Montant</strong></th>
                                            <th><strong>Date de réception</strong></th>
                                            <th scope="col"><strong>Actions</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @forelse ($derniers_approvisionnements as $approvisionnement)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $approvisionnement->produit->nom }}</td>
                                                <td>{{ $approvisionnement->qte_appro }}</td>
                                                <td>{{ number_format($approvisionnement->montant_total, 2) }} FCFA</td>
                                                <td><span class="badge bg-warningbadge border-warning border-1 text-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#historiqueProduit{{ $approvisionnement->produit->id }}">{{ $approvisionnement->date_approvisionnement }}</span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#editModal{{ $approvisionnement->id }}"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="bi bi-pencil-square me-3"></i></a>
                                                        <form
                                                            action="{{ route('approvisionnement.destroy', $approvisionnement->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i
                                                                    class="bi bi-trash me-3"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Aucun approvisionnement trouvé.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                            tabindex="0">
                            <div class="table-responsive">
                                <table
                                    class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                                    <thead class="bg-light text-center">
                                        <tr>
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Designation</strong></th>
                                            <th><strong>Quantité</strong></th>
                                            <th><strong>Historique</strong></th>
                                            <!--th><strong>Actions</strong></th-->
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>1</td>
                                            <td>stock Names</td>
                                            <td>NanNan</td>
                                            <td><span class="badge bg-warningbadge border-warning border-1 text-warning"
                                                    data-bs-toggle="modal" data-bs-target="#entree">00/00/20##</span></td>
                                            <!--td>
                                                                                                                                                                <div>
                                                                                                                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#stock"
                                                                                                                                                                        class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                                                                                                                            class="bi bi-pencil-square me-3"></i></a>
                                                                                                                                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                                                                                                                                            class="bi bi-trash me-3"></i></a>
                                                                                                                                                                </div>
                                                                                                                                                            </td-->
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
                                    <thead class="bg-light text-center">
                                        <tr>
                                            <th style="width:80px;"><strong>#</strong></th>
                                            <th><strong>Designation</strong></th>
                                            <th><strong>Quantité</strong></th>
                                            <th><strong>Historique</strong></th>
                                            <!--th><strong>Actions</strong></th-->
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td scope="row">1</td>
                                            <td class="bg-white">stock Names</td>
                                            <td>NanNan XOF</td>
                                            <td><span class="badge bg-warningbadge border-warning border-1 text-warning"
                                                    data-bs-toggle="modal" data-bs-target="#sortie">00/00/20##</span></td>
                                            <!--td>
                                                                                                                                                                <div>
                                                                                                                                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#stock"
                                                                                                                                                                        class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                                                                                                                            class="bi bi-pencil-square me-3"></i></a>
                                                                                                                                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                                                                                                                                            class="bi bi-trash me-3"></i></a>
                                                                                                                                                                </div>
                                                                                                                                                            </td-->
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

    <div class="modal fade" id="entree" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">Historique des entrées</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Designation</strong></th>
                                    <th><strong>Quantité</strong></th>
                                    <th><strong>Historique</strong></th>
                                    <!--th><strong>Actions</strong></th-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>stock Names</td>
                                    <td>NanNan</td>
                                    <td><span class="badge bg-warningbadge border-warning border-1 text-warning"
                                            data-bs-toggle="modal" data-bs-target="#bilan">00/00/20##</span></td>
                                    <!--td>
                                                                                                                        <div>
                                                                                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#stock"
                                                                                                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                                                                                    class="bi bi-pencil-square me-3"></i></a>
                                                                                                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                                                                                                    class="bi bi-trash me-3"></i></a>
                                                                                                                        </div>
                                                                                                                    </td-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sortie" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">Historique des sorties</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th style="width:80px;"><strong>#</strong></th>
                                    <th><strong>Designation</strong></th>
                                    <th><strong>Quantité</strong></th>
                                    <th><strong>Historique</strong></th>
                                    <!--th><strong>Actions</strong></th-->
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center">
                                    <td>1</td>
                                    <td>stock Names</td>
                                    <td>NanNan</td>
                                    <td><span class="badge bg-warningbadge border-warning border-1 text-warning"
                                            data-bs-toggle="modal" data-bs-target="#bilan">00/00/20##</span></td>
                                    <!--td>
                                                                                                                        <div>
                                                                                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#stock"
                                                                                                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                                                                                    class="bi bi-pencil-square me-3"></i></a>
                                                                                                                            <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                                                                                                    class="bi bi-trash me-3"></i></a>
                                                                                                                        </div>
                                                                                                                    </td-->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection