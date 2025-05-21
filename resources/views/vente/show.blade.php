@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Historique du produit: <span>{{ $ventes->first()->produit->nom ?? '' }}</span></h2>
                    </div>
                    <div>
                        <a href="{{route('approvisionnement.index')}}" class="btn btn-light">Retour</a>
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
                                <div class="col-md-12 col-12">
                                    <form method="GET" class="mb-4">
                                        <div class="row g-6 align-items-center">
                                            <div class="col-auto">
                                                <label for="date_debut" class="col-form-label">Date de début :</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" id="date_debut" name="date_debut" class="form-control"
                                                    value="{{ request('date_debut') }}">
                                            </div>
                                            <div class="col-auto">
                                                <label for="date_fin" class="col-form-label">Date de fin :</label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="date" id="date_fin" name="date_fin" class="form-control"
                                                    value="{{ request('date_fin') }}">
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
                            <table
                                class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th style="width:80px;">N°</th>
                                        <th>Date</th>
                                        <th>TV(XOF)</th>
                                        <th>JNP PASS(XOF)</th>
                                        <th>Comptant(XOF)</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ventesParJour as $date => $ventesJour)
                                        @php
                                            $tv = $ventesJour->where('paiement.nom', 'Ticket Valeur')->sum('montant_total');
                                            $jnp = $ventesJour->where('paiement.nom', 'JNP Pass')->sum('montant_total');
                                            $comptant = $ventesJour->where('paiement.nom', 'Espèce')->sum('montant_total');
                                            $total = $tv + $jnp + $comptant;
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
                                            <td>{{ number_format($tv, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($jnp, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($comptant, 0, ',', ' ') }}</td>
                                            <td>{{ number_format($total, 0, ',', ' ') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                        <span> Affichage de {{ $ventes->firstItem() }} à {{ $ventes->lastItem() }} sur
                            {{ $ventes->total() }} résultats</span>
                        <nav>
                            <ul class="pagination mb-0">
                                <!-- Previous button -->
                                <li class="page-item {{ $ventes->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $ventes->previousPageUrl() }}" tabindex="-1">Prec</a>
                                </li>

                                <!-- Display limited number of pages (3 pages max) -->
                                @foreach ($ventes->getUrlRange(1, 3) as $page => $url)
                                    <li class="page-item {{ $page == $ventes->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                <!-- Next button -->
                                <li class="page-item {{ $ventes->hasMorePages() ? '' : 'disabled' }}">
                                    <a class="page-link" href="{{ $ventes->nextPageUrl() }}">Suiv</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection