@extends('Gerant.LayoutGerant')
@section('content-body')

<div class="modal fade" id="product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Nouveau produit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gerant.dashboard.produit.store') }}" method="POST">
                @csrf
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <label for="recipient-name" class="col-form-label">Nom du Produit</label>
                            <input type="text"  class="form-control pop">
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