@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Liste des catégories</h2>
                    </div>
                    <div>
                         <a href="{{ route('voirC.pdf') }}" target="_blank" class="btn btn-secondary">
                            📄 Télécharger PDF 
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#categorie">Nouvelle catégorie</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="px-6 py-6">
                        <div class="d-flex justify-content-between flex-row align-items-center">
                            <div class="col-lg-12 col-md-6 col-12">
                                <form method="GET" action="{{ route('categorie.index') }}" class="d-flex mb-3">
                                    <input class="form-control me-2" type="search" name="search"
                                        placeholder="Rechercher une categorie" value="{{ request('search') }}"
                                        aria-label="Search">
                                    <span class="input-group-append">
                                        <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                            type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
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
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id=""
                                class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                                <thead class="bg-light">
                                    <tr class="">
                                        <th>
                                            N°
                                        </th>
                                        <th>Nom</th>
                                        <th>Description</th>
                                        <th>Date de Création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $categorie)
                                        <tr class="">
                                            <td> {{ $loop->iteration }}</td>
                                            <td>{{ $categorie->nom }}</td>
                                            <td><span class="badge bg-warning" data-bs-toggle="modal"
                                                    data-bs-target="#description-{{ $categorie->id }}">VOIR</span>
                                            </td>
                                            <!-- Modal -->
                                            <div class="modal fade" id="description-{{ $categorie->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                Description</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>{{ $categorie->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <td>{{ $categorie->created_at }}</td>
                                            <td>
                                                <div class="d-flex text-end">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#modifier-{{ $categorie->id }}"
                                                        class="btn btn-primary shadow btn-xs sharp me-2"><i
                                                            class="bi bi-pencil-square "></i></a>
                                                    <form action="{{ route('categorie.destroy', $categorie->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette categorie ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        @include('categorie.edit')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                        <span></span>
                        <nav>
                            <ul class="pagination mb-0">
                                <!-- Previous button -->
                                <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $categories->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>

                                <!-- Display limited number of pages (2 pages max) -->
                                @foreach ($categories->getUrlRange(1, 2) as $page => $url)
                                    <li class="page-item {{ $page == $categories->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Next button -->
                                <li class="page-item {{ $categories->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $categories->nextPageUrl() }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('categorie.create')
@endsection