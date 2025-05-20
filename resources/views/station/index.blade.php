@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Liste des stations services</h2>
                    </div>

                    <div>
                        <a href="{{ route('export.pdf', ['type' => 'stations']) }}" target="_blank" class="btn btn-secondary">
                            📄 Télécharger PDF 
                        </a>
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
                            <div class="col-lg-12 col-md-6 col-12 mb-2 mb-md-0">
                                <form method="GET" action="{{ route('station.index') }}" class="d-flex mb-3">
                                    <input class="form-control me-2" type="search" name="search"
                                        placeholder="Rechercher une station" value="{{ request('search') }}"
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
                            <table id="stationTable"
                                class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
                                <thead class="bg-light">
                                    <tr class="">
                                        <th>
                                            N°
                                        </th>
                                        <th>Nom</th>
                                        <th>RCCM</th>
                                        <th>IFU</th>
                                        <th>Adresse</th>
                                        <th>Itinéraire</th>
                                        <th>Email</th>
                                        <th>Contact</th>
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
                                            <td><a href="https://www.google.com/maps/dir/?api=1&destination={{ $station->latitude }},{{ $station->longitude }}"
                                                    target="_blank">
                                                    Voir l'itinéraire
                                                </a></td>
                                            <td>{{ $station->gerant->email ?? 'Email non disponible' }}</td>
                                            <td>{{ $station->contact }}</td>
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
                                <!-- Previous button -->
                                <li class="page-item {{ $stations->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $stations->previousPageUrl() }}"
                                        tabindex="-1">Previous</a>
                                </li>

                                <!-- Display limited number of pages (3 pages max) -->
                                @foreach ($stations->getUrlRange(1, 3) as $page => $url)
                                    <li class="page-item {{ $page == $stations->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Next button -->
                                <li class="page-item {{ $stations->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $stations->nextPageUrl() }}">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection