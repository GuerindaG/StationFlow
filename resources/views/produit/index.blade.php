@extends('Gerant.LayoutGerant')
@section('content-body')
		<div class="card h-100 card-lg mb-5">
			<div class="card-body">
				<div class="row p-5">
					<form role="Rechercher" class="col-lg-9">
						<input class="form-control" type="search" placeholder="Rechercher" aria-label="Search" />
					</form>
					<div class="col-lg-3 ">
						<button class="btn btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#product">Ajouter
							un produit</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
				<div class="card h-100 card-lg mb-5">
					<div class="card-header d-block d-sm-flex border-0">
						<div class="col-lg-7 p-6">
							<h3 class="mb-0 fs-5">Gestion des produits</h3>
						</div>
						<div class="col-lg-5 text-end">
							<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="#" aria-current="true" id="home-tab"
										data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button"
										role="tab">Produits blancs</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="#" id="profile-tab" data-bs-toggle="tab"
										data-bs-target="#profile-tab-pane" type="button" role="tab">Gaz et
										accessoires</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="lam-tab" data-bs-toggle="tab" data-bs-target="#lam-tab-pane"
										type="button" role="tab">Lubrifiants</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="card-body p-0 ">
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
								aria-labelledby="home-tab" tabindex="0">
								<div class="table-responsive">
									<table
										class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
										<thead class="bg-light">
											<tr>
												<th>#</th>
												<th>Désignations</th>
												<th>Prix Unitaires</th>
												<th>Dates d'enregistrement</strong></th>
												<th scope="col">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>01</strong></td>
												<td></td>
												<td></td>
												<td></td>
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
							<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
								tabindex="0">
								<div class="table-responsive">
									<table
										class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
										<thead class="bg-light">
											<tr>
												<th>#</th>
												<th>Désignations</th>
												<th>Prix Unitaires</th>
												<th>Dates d'enregistrement</strong></th>
												<th scope="col">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><strong>01</strong></td>
												<td></td>
												<td></td>
												<td></td>
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
							<div class="tab-pane fade" id="lam-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
								tabindex="0">
								<div class="table-responsive">
									<table
										class="table table-responsive-md table-centered table-borderless text-nowrap table-hover">
										<thead class="bg-light">
											<tr>
												<th>#</strong></th>
												<th>Désignations</th>
												<th>Prix Unitaires</th>
												<th>Dates d'enregistrement</th>
												<th scope="col">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><strong>01</strong></td>
												<td></td>
												<td></td>
												<td></td>
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
						</div>
					</div>
				</div>
			</div>
		</div>

	<div class="modal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau produit</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="row mb-2">
							<div class="col-sm-12">
								<label for="recipient-name" class="col-form-label">Nom du Produit</label>
								<input type="text" class="form-control pop">
							</div>

						</div>
						<div class="row mb-2">
							<div class="col-sm-6">
								<label for="recipient-name" class="col-form-label">Catégorie</label>
								<select class="default-select form-control wide">
									<option>Produits blancs</option>
									<option>Gaz et accessoires</option>
									<option>Lubrifiants</option>
								</select>
							</div>
							<div class="col-sm-6">
								<label for="recipient-name" class="col-form-label">Prix Unitaire</label>
								<input type="number" placeholder="" class="form-control pop">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-primary">Enregistrer</button>
				</div>
			</div>
		</div>
	</div>
	
@endsection