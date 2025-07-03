<?php

namespace App\Exports;

use App\Models\Approvisionnement;
use Maatwebsite\Excel\Concerns\FromCollection;

class ApprovisionnementsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $approvisionnements;

    public function __construct($approvisionnements)
    {
        $this->approvisionnements = $approvisionnements;
    }
    public function collection()
    {
        return $this->approvisionnements->map(function ($item) {
            return [
                'Date' => $item->date_approvisionnement->format('d/m/Y'),
                'Produit' => $item->produit->nom,
                'Catégorie' => $item->produit->categorie->nom,
                'Quantité' => $item->qte_appro,
                'Prix Unitaire' => $item->produit->prix_achat,
                'Montant Total' => $item->montant_total,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Date',
            'Produit',
            'Catégorie',
            'Quantité',
            'Prix Unitaire',
            'Montant Total'
        ];
    }
}
