<!-- Modal -->
<div class="modal fade" id="editModal{{ $approvisionnement->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="categorieLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-6 d-flex flex-column gap-6">
            <div class="d-flex flex-row align-items-center justify-content-between">
                <h5 class="modal-title" id="categorieLabel">Modifier {{ $approvisionnement->produit->nom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <form action="{{ route('approvisionnement.update', $approvisionnement->id) }}" method="POST"
                    class="row needs-validation g-3" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="d-flex flex-row gap-3">
                        <div class="col-sm-6 p-2">
                            <label for="qte_appro" class="form-label">Quantité</label>
                            <input type="number" class="form-control" name="qte_appro"
                                value="{{ $approvisionnement->qte_appro }}" required>
                        </div>

                        <div class="col-sm-6 p-2">
                            <label for="date_approvisionnement" class="form-label">Date de réception</label>
                            <input type="date" class="form-control" name="date_approvisionnement"
                                value="{{ $approvisionnement->date_approvisionnement }}" required>
                        </div>
                    </div>
                    <div class="d-flex flex-row gap-3 p-2">
                        <button type="submit" class="btn btn-primary w-50">Enregistrer</button>
                        <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>