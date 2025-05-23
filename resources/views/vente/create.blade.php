@extends('Gerant.LayoutGerant')
@section('content-body')
    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Enregistrer une vente</h2>
                    </div>
                    <div>
                        <a href="{{route('vente.index')}}" class="btn btn-light">Retour</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- card -->
                <div class="card mb-6 shadow border-0">
                    <form action="{{ route('vente.store') }}" method="POST" class="row needs-validation g-3" novalidate>
                        @csrf
                        <div class="card-body p-6">
                            <table class="table" id="venteTable">
                                <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Moyen de paiement</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="ventes[0][categorie_id]" class="form-control categorie-select">
                                                <option value="">Choisir</option>
                                                @foreach($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="ventes[0][produit_id]" class="form-control produit-select">
                                                <option value="">--</option>
                                            </select>
                                        </td>
                                        <td><input type="number" name="ventes[0][quantite]" class="form-control"></td>
                                        <td>
                                            <select name="ventes[0][paiement_id]" class="form-control">
                                                <option value="">Choisir</option>
                                                @foreach($paiements as $paiement)
                                                    <option value="{{ $paiement->id }}">{{ $paiement->nom }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><button type="button" class="btn btn-danger">X</button></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-auto">
                                <button type="button" id="addRow" class="btn btn-success"><i
                                        class="fa-solid fa-plus"></i></button>
                                <button type="submit" class="btn btn-primary text-end">Enregistrer</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection