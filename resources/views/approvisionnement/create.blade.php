<!-- Modal -->
<div class="modal fade" id="stock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="categorieLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <h5 class="modal-title" id="categorieLabel">Créer une categorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form action="{{ route('approvisionnement.store') }}" method="POST" class="row needs-validation g-3"
                    novalidate>
                    @csrf
                    <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Catégorie</label>
                        <select class="default-select form-control wide" id="categorie_id" name="categorie_id">
                            <option value="">Sélectionnez une catégorie</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Produits</label>
                        <select class="default-select form-control wide" id="produit_id" name="produit_id">
                            <option value="">Sélectionnez une catégorie d'abord</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="recipient-name" class="col-form-label">Quantité</label>
                        <input type="number" placeholder="" id="qte_appro" name="qte_appro" class="form-control pop">
                    </div>
                    <!-- input -->
                    <div class="col-sm-12">
                        <label class="form-label">Date de réception</label>
                        <input type="date" class="form-control flatpickr" name="date_approvisionnement"
                            placeholder="Select Date" />
                    </div>
                    <div class="d-flex flex-row gap-3">
                        <button type="submit" class="btn btn-primary">Créer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>