<div class="modal fade" id="produit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Créer un produit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produit.store') }}" method="POST">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-sm-5">
                            <label for="recipient-name" class="col-form-label">Nom du Produit</label>
                            <input type="text" name="nom" class="form-control pop">
                        </div>

                        <div class="col-sm-5">
                            <label for="recipient-name" class="col-form-label">Catégorie</label>
                            <select class="default-select form-control wide" id="categorie_id" name="categorie_id">
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <label for="recipient-name" class="col-form-label">Prix Unitaire</label>
                            <input type="number" placeholder="" id="prix_unitaire" name="prix_unitaire"
                                class="form-control pop">
                        </div>
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