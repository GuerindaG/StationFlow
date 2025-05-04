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
						<div class="row justify-content-between mb-3">
							<div class="col-lg-4 col-md-6 col-12">
								<input id="search-input" type="search" class="form-control"
									placeholder="Rechercher un produit..." />
							</div>
							<div class="col-xl-3 col-md-4 col-12">
								<select id="categorie-select" class="form-select">
									<option value="">Toutes les catégories</option>
									@foreach($categories as $categorie)
										<option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
									@endforeach
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
										<tr class="text-center" data-categorie-id="{{ $produit->categorie_id }}">
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

	<script>
		// Configuration
		const ITEMS_PER_PAGE = 5;
		let currentPage = 1;
		let filteredProducts = [];
		let allProducts = [];

		// Attendre que le DOM soit chargé
		document.addEventListener('DOMContentLoaded', function () {
			// Récupérer tous les produits du tableau
			const productRows = Array.from(document.querySelectorAll('tbody tr'));

			// Stocker les données des produits pour une utilisation future
			allProducts = productRows.map(row => {
				const columns = row.querySelectorAll('td');
				return {
					element: row,
					id: row.querySelector('form') ? row.querySelector('form').action.split('/').pop().split('?')[0] : '',
					nom: columns[1].textContent.trim(),
					prix: columns[2].textContent.trim(),
					date: columns[3].textContent.trim(),
					categorie_id: row.dataset.categorieId || '',
					numero: columns[0].textContent.trim()
				};
			});

			// Initialiser avec tous les produits
			filteredProducts = [...allProducts];

			// Ajouter les écouteurs d'événements
			document.getElementById('search-input').addEventListener('input', filterProducts);
			document.getElementById('categorie-select').addEventListener('change', filterProducts);

			// Initialiser la pagination
			updatePagination();
			displayProducts();
			initializePaginationControls();
		});

		// Fonction de filtrage principale
		function filterProducts() {
			const searchTerm = document.getElementById('search-input').value.toLowerCase();
			const selectedCategory = document.getElementById('categorie-select').value;

			// Appliquer les filtres
			filteredProducts = allProducts.filter(product => {
				const matchesSearch = product.nom.toLowerCase().includes(searchTerm) ||
					product.prix.toLowerCase().includes(searchTerm);
				const matchesCategory = !selectedCategory || product.categorie_id === selectedCategory;

				return matchesSearch && matchesCategory;
			});

			// Réinitialiser à la première page après filtrage
			currentPage = 1;

			// Mettre à jour l'affichage
			updatePagination();
			displayProducts();
		}

		// Afficher les produits pour la page actuelle
		function displayProducts() {
			const tbody = document.querySelector('tbody');
			tbody.innerHTML = '';

			const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
			const endIndex = Math.min(startIndex + ITEMS_PER_PAGE, filteredProducts.length);

			if (filteredProducts.length === 0) {
				const emptyRow = document.createElement('tr');
				emptyRow.innerHTML = '<td colspan="5" class="text-center">Aucun produit trouvé</td>';
				tbody.appendChild(emptyRow);
				return;
			}

			// Afficher les produits de la page actuelle
			for (let i = startIndex; i < endIndex; i++) {
				const product = filteredProducts[i];
				const clonedRow = product.element.cloneNode(true);

				// Mettre à jour le numéro pour refléter l'ordre actuel
				clonedRow.querySelector('td:first-child').textContent = i + 1;

				tbody.appendChild(clonedRow);
			}
		}

		// Mettre à jour les contrôles de pagination
		function updatePagination() {
			const totalPages = Math.max(1, Math.ceil(filteredProducts.length / ITEMS_PER_PAGE));
			const paginationContainer = document.querySelector('.pagination');
			paginationContainer.innerHTML = '';

			// Bouton "Précédent"
			const prevButton = createPaginationItem('Previous', currentPage > 1);
			prevButton.addEventListener('click', function (e) {
				e.preventDefault();
				if (currentPage > 1) {
					currentPage--;
					displayProducts();
					updatePaginationActive();
				}
			});
			paginationContainer.appendChild(prevButton);

			// Pages numérotées
			const maxVisiblePages = 5;
			let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
			let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

			if (endPage - startPage + 1 < maxVisiblePages) {
				startPage = Math.max(1, endPage - maxVisiblePages + 1);
			}

			for (let i = startPage; i <= endPage; i++) {
				const pageItem = createPaginationItem(i.toString(), true, i === currentPage);
				pageItem.addEventListener('click', function (e) {
					e.preventDefault();
					currentPage = i;
					displayProducts();
					updatePaginationActive();
				});
				paginationContainer.appendChild(pageItem);
			}

			// Bouton "Suivant"
			const nextButton = createPaginationItem('Next', currentPage < totalPages);
			nextButton.addEventListener('click', function (e) {
				e.preventDefault();
				if (currentPage < totalPages) {
					currentPage++;
					displayProducts();
					updatePaginationActive();
				}
			});
			paginationContainer.appendChild(nextButton);

			// Afficher le compteur de résultats
			const countSpan = document.querySelector('.border-top span');
			countSpan.textContent = `Affichage de ${filteredProducts.length > 0 ?
				(currentPage - 1) * ITEMS_PER_PAGE + 1 : 0} à ${Math.min(currentPage * ITEMS_PER_PAGE, filteredProducts.length)
				} sur ${filteredProducts.length} produits`;
		}

		// Créer un élément de pagination
		function createPaginationItem(text, enabled, active = false) {
			const li = document.createElement('li');
			li.className = `page-item${enabled ? '' : ' disabled'}${active ? ' active' : ''}`;

			const a = document.createElement('a');
			a.className = 'page-link';
			a.href = '#!';
			a.textContent = text;

			li.appendChild(a);
			return li;
		}

		// Mettre à jour la classe active dans la pagination
		function updatePaginationActive() {
			document.querySelectorAll('.pagination .page-item').forEach(item => {
				item.classList.remove('active');
				if (item.textContent === currentPage.toString()) {
					item.classList.add('active');
				}
			});
		}

		// Initialiser les contrôles de pagination
		function initializePaginationControls() {
			document.querySelectorAll('.pagination .page-item').forEach(item => {
				const pageLink = item.querySelector('.page-link');
				if (pageLink) {
					const pageText = pageLink.textContent;

					item.addEventListener('click', function (e) {
						e.preventDefault();

						if (item.classList.contains('disabled')) {
							return;
						}

						if (pageText === 'Previous') {
							if (currentPage > 1) {
								currentPage--;
							}
						} else if (pageText === 'Next') {
							const totalPages = Math.ceil(filteredProducts.length / ITEMS_PER_PAGE);
							if (currentPage < totalPages) {
								currentPage++;
							}
						} else {
							currentPage = parseInt(pageText);
						}

						displayProducts();
						updatePaginationActive();
					});
				}
			});
		}
	</script>
@endsection