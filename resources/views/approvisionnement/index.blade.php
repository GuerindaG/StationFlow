@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-4">
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
                    </div>
                    <div class="card-body p-0">
                        <div class="p-6">
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <form method="GET" class="mb-4">
                                        <div class="row g-3 align-items-center">
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
                                                <a href="{{ route('approvisionnement.index') }}"
                                                    class="btn btn-btn btn-outline-gray-400 text-muted">
                                                    <i class="fa-solid fa-refresh"></i></a>
                                                <a href="{{ route('voirS.pdf') }}" target="_blank" class="btn btn-dark">
                                                    <i class="bi bi-download"></i>
                                                </a>
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
                                                            class="bi bi-pencil-square "></i></a>
                                                    <form
                                                        action="{{ route('approvisionnement.destroy', $approvisionnement->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="bi bi-trash "></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('approvisionnement.edit')
                                    @empty
                                        <tr>
                                            <td colspan="6">Enregistrer une reception ?</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                            <span> Affichage de {{ $derniers_approvisionnements->firstItem() }} à
                                {{ $derniers_approvisionnements->lastItem() }} sur
                                {{ $derniers_approvisionnements->total() }} résultats</span>
                            <nav>
                                <ul class="pagination mb-0">
                                    <!-- Previous button -->
                                    <li
                                        class="page-item {{ $derniers_approvisionnements->onFirstPage() ? 'disabled' : '' }}">
                                        <a class="page-link" href="{{ $derniers_approvisionnements->previousPageUrl() }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection