@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Enregistrer une livraison</h2>
                    </div>
                    <div>
                        <a href="{{route('approvisionnement.index')}}" class="btn btn-light">Retour</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- card -->
                <div class="card mb-6 shadow border-0">
                    <form action="{{ route('approvisionnement.store') }}" method="POST" class="row needs-validation g-3"
                        novalidate>
                        @csrf
                        <div class="card-body p-6">
                            <div class="row">
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

                                <!-- input -->
                                <div class="col-sm-12 mb-3">
                                    <label for="recipient-name" class="col-form-label">Quantité</label>
                                    <input type="number" placeholder="" id="qte_appro" name="qte_appro"
                                        class="form-control pop">
                                </div>
                                <div class="col-sm-12 mb-3">
                                    <label for="recipient-name" class="col-form-label">Date de réception</label>
                                    <input type="date" placeholder="" id="date_approvisionnement"
                                        name="date_approvisionnement" class="form-control flatpickr">
                                </div>

                                <div class="col-lg-12 text-end">
                                    <button class="btn btn-primary w-100" type="submit">Enregistrer</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection