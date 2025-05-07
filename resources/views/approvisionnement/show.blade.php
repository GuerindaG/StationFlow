<div class="modal fade" id="historiqueProduit{{ $approvisionnement->produit->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historique de réception - {{ $approvisionnement->produit->nom }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                @php
                    // Récupérer l'historique des approvisionnements pour le produit sélectionné
                    $historique = \App\Models\Approvisionnement::where('produit_id', $approvisionnement->produit_id)
                        ->orderByDesc('date_approvisionnement')
                        ->get();
                @endphp

                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quantité</th>
                            <th>Montant</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($historique->isEmpty())
                            <tr>
                                <td colspan="4">Aucun historique de livraison trouvé.</td>
                            </tr>
                        @else
                            @foreach ($historique as $index => $livraison)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $livraison->qte_appro }}</td>
                                    <td>{{ number_format($livraison->montant_total, 2) }} FCFA</td>
                                    <td>{{ $livraison->date_approvisionnement }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
