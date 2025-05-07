<!-- Modal -->
<div class="modal fade" id="categorie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="categorieLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <h5 class="modal-title" id="categorieLabel">Créer une categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form action="{{ route('categorie.store') }}" method="POST" class="row needs-validation g-3" novalidate>
                    @csrf
                    <div class="col-lg- col-12">
                        <!-- input -->
                        <label for="customerEditAdd" class="form-label">Nom de la catégorie</label>
                        <input type="text" class="form-control" name="nom" placeholder="Street categorie"
                            required />
                        <div class="invalid-feedback">Pelease enter categorie</div>
                    </div>
                    <!-- input -->
                    <div class="col-lg- col-12">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Meta Description"></textarea>
                    </div>
                    <div class="d-flex flex-row gap-3">
                        <button type="submit" class="btn btn-primary w-50">Créer</button>
                        <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>