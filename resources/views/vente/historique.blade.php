@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Historique du produit: <span>productname</span></h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">

                <div class="card h-100 card-lg">

                    <div class="card-body p-0">

                        <div class="p-6">
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <form method="GET" action="{{ route('vente.index') }}" class="d-flex mb-3">
                                        <input class="form-control me-2" type="search" name="search"
                                            placeholder="Rechercher " value="{{ request('search') }}" aria-label="Search">
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
                        <div class="table-responsive">
                            <table class="table table-centered table-hover text-nowrap table-borderless mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>N°</th>
                                        <th>Vente en TV</th>
                                        <th>Vente en JNP PASS</th>
                                        <th>Vente au Comptant</th>
                                        <th>Total</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($ventes as $approvisionnement)
                                        <tr>
                                            <td>1</td>
                                            <td>165,000 XOF</td>
                                            <td>125,000 XOF</td>
                                            <td>50,000 XOF</td>
                                            <td>340,000 XOF</td>
                                            <td>28/04/2025</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-outline-primary view-details"
                                                    data-bs-toggle="modal" data-bs-target="#detailsModal"
                                                    data-category="produits-blancs">
                                                    <i class="fas fa-eye"></i>
                                                </button>
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
@endsection