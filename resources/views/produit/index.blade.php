@extends('Admin.LayoutAdmin')
@section('content-body')

	<div class="container">
		<div class="row mb-8">
			<div class="col-md-12">
				<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
					<div>
						<h2>Inventaire des produits</h2>
					</div>
					<div>
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
						<div class="row justify-content-between">
							<div class="col-lg-4 col-md-6 col-12 mb-2 mb-md-0">
								<!-- form -->
								<form class="d-flex" role="search">
									<input class="form-control" type="search" placeholder="Rechercher un produit"
										aria-label="Search" />
								</form>
							</div>
							<!-- select option -->
							<div class="col-xl-2 col-md-4 col-12">
								<select class="form-select">
									<option selected>Catégories</option>
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
										<th>N°</th>
										<th>Désignation</th>
										<th>Prix unitaire</th>
										<th>Date d'enregistrement</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($produits as $produit)
										<tr class="text-center">
											<td>{{ $loop->iteration }}</td>
											<td>{{ $produit->nom }}</td>
											<td>{{ $produit->prix_unitaire }} FCFA</td>
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
@include('produit.create')
@endsection