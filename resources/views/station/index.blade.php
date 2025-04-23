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
                                    <option value="Published">Active</option>
                                    <option value="Unpublished">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table
                                class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                                <thead class="bg-light">
                                    <tr class="text-center">
                                        <th>
                                            N°
                                        </th>
                                        <th>Nom</th>
                                        <th>RCCM</th>
                                        <th>IFU</th>
                                        <th>Adresse</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Statut</th>
                                        <th>Date & Heure</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stations as $station)
                                        <tr>
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td><a href="#" class="text-reset">{{ $station->nom }}</a></td>
                                            <td>{{ $station->rccm }}</td>
                                            <td>{{ $station->ifu }}</td>
                                            <td>{{ $station->adresse }}</td>
                                            <td>{{ $station->gerant->email ?? 'Email non disponible' }}</td>
                                            <td>{{ $station->contact }}</td>
                                            <td>
                                                <span
                                                    class="badge {{ $station->statut == 'active' ? 'bg-light-primary text-dark-primary' : 'bg-light-danger text-dark-danger' }}">
                                                    {{ ucfirst($station->statut) }}
                                                </span>
                                            </td>
                                            <td>{{ $station->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="d-flex text-end">
                                                    <a href="{{ route('station.edit', $station->id) }}"
                                                        class="btn btn-primary shadow btn-xs sharp me-2"><i
                                                            class="bi bi-pencil-square "></i></a>
                                                    <form action="{{ route('station.destroy', $station->id) }}" method="POST"
                                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette station ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger shadow btn-xs sharp">
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