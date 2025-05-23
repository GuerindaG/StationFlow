@extends('Admin.LayoutAdmin')
@section('content-body')

	<div class="container">
		<div class="row mb-8">
			<div class="col-md-12">
				<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
					<div>
						<h2>Liste des produits</h2>
					</div>
					<div>
						<a href="{{ route('voir.pdf') }}" target="_blank" class="btn btn-gray-400">
							📄 Télécharger PDF
						</a>
						<button type="button" class="btn btn-primary" data-bs-toggle="modal"
							data-bs-target="#produit">Ajouter un produit</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-12 mb-5">
				<div class="card h-100 card-lg">
					<div class="px-6 py-6">
						<div class="row justify-content-between mb-3">
							<div class="col-lg-9 col-md-6 col-12">
								<form method="GET" action="{{ route('produit.index') }}" class="d-flex mb-3">
									<input class="form-control me-2" type="search" name="search"
										placeholder="Rechercher un produit" value="{{ request('search') }}"
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
							<div class="col-xl-3 col-md-4 col-12">
								<form method="GET" action="{{ route('produit.index') }}">
									<select name="categorie_id" onchange="this.form.submit()" class="form-select">
										<option value="">Toutes les catégories</option>
										@foreach($categories as $categorie)
											<option value="{{ $categorie->id }}" {{ request('categorie_id') == $categorie->id ? 'selected' : '' }}>
												{{ $categorie->nom }}
											</option>
										@endforeach
									</select>
								</form>
							</div>
						</div>
					</div>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table
								class="table table-centered table-hover mb-0 text-nowrap table-borderless table-with-checkbox">
								<thead class="bg-light">
									<tr class="">
										<th>N°</th>
										<th>Désignation</th>
										<th>Viscosité</th>
										<th>Prix d'achat</th>
										<th>Prix de vente</th>
										<th>Marge</th>
										<th>Date d'enregistrement</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($produits as $produit)
										<tr class="">
											<td>{{ $produit->id }}</td>
											<td>{{ $produit->nom }}</td>
											<td>{{ $produit->viscosite ?? "Néant"}}</td>
											<td>{{ $produit->prix_achat }} </td>
											<td>{{ $produit->prix_vente }} </td>
											<td>{{ $marge = ($produit->prix_vente - $produit->prix_achat) }} </td>
											<td>{{ $produit->created_at }}</td>
											<td>
												@include('produit.edit')
												<div class="d-flex text-end">
													<a href="#" data-bs-toggle="modal"
														data-bs-target="#modifier-{{ $produit->id }}"
														class="btn btn-primary shadow btn-xs sharp me-2">
														<i class="bi bi-pencil-square"></i>
													</a>
													<form action="{{ route('produit.destroy', $produit->id) }}" method="POST"
														onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
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
								<li class="page-item {{ $produits->onFirstPage() ? 'disabled' : '' }}">
									<a class="page-link" href="{{ $produits->previousPageUrl() }}"
										tabindex="-1">Previous</a>
								</li>

								<!-- Display limited number of pages (3 pages max) -->
								@foreach ($produits->getUrlRange(1, 3) as $page => $url)
									<li class="page-item {{ $page == $produits->currentPage() ? 'active' : '' }}">
										<a class="page-link" href="{{ $url }}">{{ $page }}</a>
									</li>
								@endforeach

								<!-- Next button -->
								<li class="page-item {{ $produits->hasMorePages() ? '' : 'disabled' }}">
									<a class="page-link" href="{{ $produits->nextPageUrl() }}">Next</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('produit.create')
@endsection