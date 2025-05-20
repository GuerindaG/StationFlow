@extends('Gerant.LayoutGerant')
@section('content-body')
    <?php
    use App\Models\Approvisionnement; ?>

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Gestion des stocks</h2>
                    </div>
                    <div>
                        <a href="{{route('approvisionnement.create')}}" class="btn btn-primary">Nouvelle réception</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="card-header d-block d-sm-flex border-0">
                        <div class="col-lg-8 p-6">
                        </div>
                        <div class="col-lg-4 text-end">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="lam-tab" data-bs-toggle="tab"
                                        data-bs-target="#lam-tab-pane" type="button" role="tab">Livraisons</a>
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
                    <div class="card-body p-0">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="lam-tab-pane" role="tabpanel"
                                aria-labelledby="contact-tab" tabindex="0">
                                <div class="p-6">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <form method="GET" action="{{ route('approvisionnement.index') }}"
                                                class="d-flex mb-3">
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
                                                <th>Produit</th>
                                                <th>Quantité(L- Kg)</th>
                                                <th>Montant(XOF)</th>
                                                <th>Date de réception</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($derniers_approvisionnements as $approvisionnement)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $approvisionnement->produit->nom }}</td>
                                                    <td>{{ $approvisionnement->qte_appro }}</td>
                                                    <td>{{ number_format($approvisionnement->montant_total, 2) }}</td>
                                                    <td><a href="{{ route('approvisionnement.show', $approvisionnement->produit->id) }}"
                                                            class="badge bg-warningbadge border-warning border-1 text-warning">{{ $approvisionnement->date_approvisionnement }}</a>
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
                                                                <button type="submit"
                                                                    class="btn btn-danger shadow btn-xs sharp"><i
                                                                        class="bi bi-trash me-3"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('approvisionnement.edit')
                                            @empty
                                                <tr>
                                                    <td colspan="6">Aucun approvisionnement trouvé.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span>Showing 1 to 8 of 12 entries</span>
                                    <nav>
                                        <ul class="pagination mb-0">
                                            <!-- Previous button -->
                                            <li
                                                class="page-item {{ $derniers_approvisionnements->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $derniers_approvisionnements->previousPageUrl() }}"
                                                    tabindex="-1">Prec</a>
                                            </li>

                                            <!-- Display limited number of pages (3 pages max) -->
                                            @foreach ($derniers_approvisionnements->getUrlRange(1, 3) as $page => $url)
                                                <li
                                                    class="page-item {{ $page == $derniers_approvisionnements->currentPage() ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next button -->
                                            <li
                                                class="page-item {{ $derniers_approvisionnements->hasMorePages() ? '' : 'disabled' }}">
                                                <a class="page-link"
                                                    href="{{ $derniers_approvisionnements->nextPageUrl() }}">Suiv</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                                tabindex="0">
                                <div class="p-6">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <form method="GET" class="mb-4">
                                                <div class="row g-6 align-items-center">
                                                    <div class="col-auto">
                                                        <label for="date_debut" class="col-form-label">Date de début
                                                            :</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="date" id="date_debut" name="date_debut"
                                                            class="form-control" value="{{ request('date_debut') }}">
                                                    </div>
                                                    <div class="col-auto">
                                                        <label for="date_fin" class="col-form-label">Date de fin :</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="date" id="date_fin" name="date_fin"
                                                            class="form-control" value="{{ request('date_fin') }}">
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
                                                <th>Designation</th>
                                                <th>Quantité</th>
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>stock Names</td>
                                                <td>NanNan</td>
                                                <td><span class="badge bg-warningbadge border-warning border-1 text-warning"
                                                        data-bs-toggle="modal" data-bs-target="#entree">00/00/20##</span>
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
                                        <div class="col-md-12 col-12">
                                            <form method="GET" class="mb-4">
                                                <div class="row g-6 align-items-center">
                                                    <div class="col-auto">
                                                        <label for="date_debut" class="col-form-label">Date de début
                                                            :</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="date" id="date_debut" name="date_debut"
                                                            class="form-control" value="{{ request('date_debut') }}">
                                                    </div>
                                                    <div class="col-auto">
                                                        <label for="date_fin" class="col-form-label">Date de fin :</label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="date" id="date_fin" name="date_fin"
                                                            class="form-control" value="{{ request('date_fin') }}">
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
                                                <th>Designation</th>
                                                <th>Quantité</th>
                                                <th>Historique</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>stock Names</td>
                                                <td>NanNan</td>
                                                <td><span class="badge bg-warningbadge border-warning border-1 text-warning"
                                                        data-bs-toggle="modal" data-bs-target="#entree">00/00/20##</span>
                                                </td>
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
    </div>
@endsection