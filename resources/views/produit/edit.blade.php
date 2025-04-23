
    <div class="modal fade" id="modifier-{{ $produit->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">modifier le produit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('produit.update',$produit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <label for="recipient-name" class="col-form-label">Nom du Produit</label>
                                <input type="text" name="nom" value="{{ $produit->nom }}" class="form-control pop">
                            </div>

                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label">Catégorie</label>
                                <select class="default-select form-control wide" id="categorie_id" name="categorie_id">
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}" {{ $produit->categorie_id == $categorie->id ? 'selected' : '' }}>
                                            {{ $categorie->nom }}
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="recipient-name" class="col-form-label">Prix Unitaire</label>
                                <input type="number" placeholder="" id="prix_unitaire" value="{{ $produit->prix_unitaire }}" name="prix_unitaire"
                                    class="form-control pop">
                            </div>
                        </div>
                        <div class="d-flex flex-row gap-3">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

