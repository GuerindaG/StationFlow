@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Liste des catégories</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="address-tab-pane" role="tabpanel"
                        aria-labelledby="address-tab" tabindex="0">
                        <div class="card h-100 card-lg">
                            <div class="p-6">
                                <div class="d-flex justify-content-between flex-row align-items-center">
                                    <div>
                                        <h3 class="mb-0 h6">Catégories</h3>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#categorie">Nouvelle catégorie</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table
                                        class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
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
                                                        role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalCenterTitle">
                                                                        Description</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
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
                                                        @include('categorie.edit')
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
                                                                <button type="submit"
                                                                    class="btn btn-danger shadow btn-xs sharp">
                                                                    <i class="bi bi-trash"></i>
                                                                </button>
                                                            </form>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span></span>
                                    <nav class="mt-2 mt-md-0">
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
    </div>
    @include('categorie.create')
@endsection