@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Stations services</h2>
                    </div>
                    <div>
                        <a href="{{route('station.create')}}" class="btn btn-primary">Ajouter une station</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-12 mb-5">
                <div class="card h-100 card-lg">
                    <div class="px-6 py-6">
                        <div class="row justify-content-between">
                            <div class="col-lg-4 col-md-6 col-12 mb-2 mb-md-0">
                                <!-- form -->
                                <form class="d-flex" role="search">
                                    <input class="form-control" type="search" placeholder="Rechercher une  station"
                                        aria-label="Search" />
                                </form>
                            </div>
                            <!-- select option -->
                            <div class="col-xl-2 col-md-4 col-12">
                                <select class="form-select">
                                    <option selected>Status</option>
                                    <option value="Published">Activée</option>
                                    <option value="Unpublished">Désactivée</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table
                                class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                                <thead class="bg-light">
                                    <tr>
                                        <th>
                                            N°
                                        </th>
                                        <th>Logo</th>
                                        <th>Code Station</th>
                                        <th>RCCM</th>
                                        <th>IFU</th>
                                        <th>Adresse</th>
                                        <th>Contact</th>
                                        <th>Statut</th>
                                        <th>Date & Heure</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            <a href="#!"><img src="../assets/images/icons/bakery.svg" alt=""
                                                    class="icon-shape icon-sm" /></a>
                                        </td>
                                        <td><a href="#" class="text-reset">0003</a></td>
                                        <td>8456595656</td>
                                        <td>8456595656</td>
                                        <td>Porto-Novo</td>
                                        <td>01XXXXXXXX</td>
                                        <td>
                                            <span class="badge bg-light-primary text-dark-primary">Activée</span>
                                        </td>
                                        <td>01/05/09 07:30</td>
                                        <td>
                                            <div class="d-flex text-end">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#product"
                                                    class="btn btn-primary shadow btn-xs sharp me-2"><i
                                                        class="bi bi-pencil-square me-3"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                        class="bi bi-trash me-3"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div
                        class="border-top d-flex justify-content-between align-items-md-center px-6 py-6 flex-md-row flex-column gap-4">
                        <span></span>
                        <nav>
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