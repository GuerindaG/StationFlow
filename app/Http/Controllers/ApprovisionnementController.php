<?php

namespace App\Http\Controllers;

use App\Models\Approvisionnement;
use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Produit;
use App\Models\Stock;
use App\Services\CalculService;
use App\Services\StockService;
use Carbon\Carbon;
use DB;
use App\Exports\ApprovisionnementsExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandlesControllerErrors;
use Vtiful\Kernel\Excel;
class ApprovisionnementController extends Controller
{
    use HandlesControllerErrors;
    protected $stockService;
    protected $pricingService;

    public function __construct(StockService $stockService, CalculService $pricingService)
    {
        $this->middleware('check.station')->except(['getByCategorie']);
        $this->stockService = $stockService;
        $this->pricingService = $pricingService;
    }

    public function getByCategorie($id)
    {
        $produits = Produit::where('categorie_id', $id)->get();
        return response()->json($produits);
    }

    public function index(Request $request)
    {
        try {
            $station = Auth::user()->station;
            $date_filter = $request->input('date_filter', Carbon::today()->toDateString());
            $perPage = $request->input('per_page', 5);

            $derniers_approvisionnements = Approvisionnement::with('produit')
                ->where('station_id', $station->id)
                ->when($date_filter, function ($q) use ($date_filter) {
                    $q->whereDate('date_approvisionnement', $date_filter);
                })
                ->orderByDesc('date_approvisionnement')
                ->paginate($perPage)
                ->appends($request->query());

            $produits = Produit::select('id', 'nom')->get();
            $categories = Categorie::all();
            $paiements = Paiement::all();

            return view("approvisionnement.index", [
                'derniers_approvisionnements' => $derniers_approvisionnements,
                'produits' => $produits,
                'categories' => $categories,
                'paiements' => $paiements,
                'date_filter' => $date_filter,
                'per_page' => $perPage
            ]);
        } catch (\Exception $e) {
            return $this->handleException($e, 'gestionnaire.dashboard');
        }
    }

    public function create()
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }
        $categories = Categorie::all();
        $produits = Produit::all();
        $paiements = Paiement::all();
        return view("approvisionnement.create", compact('categories', 'produits', 'paiements'));
    }

    public function store(Request $request)
    {
        try {
            $station = Auth::user()->station;
            if (!$station) {
                return redirect()->route('gestionnaire.no-station');
            }

            $request->validate([
                'categorie_id' => 'required|exists:categories,id',
                'produit_id' => 'required|exists:produits,id',
                'qte_appro' => 'required|numeric|min:0',
                'date_approvisionnement' => 'required|date',
            ]);

            DB::transaction(function () use ($request, $station) {
                $montant_total = $this->pricingService->calculateTotalAmount(
                    $request->produit_id,
                    $request->qte_appro
                );

                Approvisionnement::create([
                    'station_id' => $station->id,
                    'produit_id' => $request->produit_id,
                    'qte_appro' => $request->qte_appro,
                    'montant_total' => $montant_total,
                    'date_approvisionnement' => $request->date_approvisionnement,
                ]);

                $this->stockService->updateStock(
                    $station->id,
                    $request->produit_id,
                    $request->qte_appro
                );
            });

            return redirect()->route('approvisionnement.index')
                ->with('success', 'Approvisionnement créé avec succès !');
        } catch (\Exception $e) {
            return $this->handleException($e, 'approvisionnement.index', true);
        }
    }

    public function show(Request $request, $id)
    {
        $station = Auth::user()->station;
        if (!$station) {
            return redirect()->route('gestionnaire.no-station');
        }

        $date_debut = $request->input('date_debut');
        $date_fin = $request->input('date_fin');

        $query = Approvisionnement::with('produit')
            ->where('station_id', $station->id)
            ->where('produit_id', $id);

        if ($date_debut && $date_fin) {
            $query->whereBetween('date_approvisionnement', [$date_debut, $date_fin]);
        }

        $approvisionnements = $query->orderByDesc('date_approvisionnement')->paginate(10);

        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        $paiements = Paiement::all();

        return view('approvisionnement.show', [
            'approvisionnements' => $approvisionnements,
            'produit' => $produit,
            'categories' => $categories,
            'paiements' => $paiements,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
    }

    public function edit(string $id)
    {
        $station = Auth::user()->station;

        $approvisionnement = Approvisionnement::where('id', $id)
            ->where('station_id', $station->id)
            ->firstOrFail();

        $categories = Categorie::all();
        $produits = Produit::where('categorie_id', $approvisionnement->produit->categorie_id)->get();

        return view('approvisionnement.edit', compact('approvisionnement', 'categories', 'produits'));
    }
    public function update(Request $request, string $id)
    {
        $station = Auth::user()->station;

        $request->validate([
            'qte_appro' => 'required|numeric|min:0',
            'date_approvisionnement' => 'required|date',
        ]);

        $approvisionnement = Approvisionnement::where('id', $id)
            ->where('station_id', $station->id)
            ->firstOrFail();

        $ancienneQte = $approvisionnement->qte_appro;

        DB::transaction(function () use ($request, $approvisionnement, $ancienneQte, $station) {
            $montant_total = $this->pricingService->calculateTotalAmount(
                $approvisionnement->produit_id,
                $request->qte_appro
            );

            $approvisionnement->update([
                'qte_appro' => $request->qte_appro,
                'montant_total' => $montant_total,
                'date_approvisionnement' => $request->date_approvisionnement,
            ]);

            // Ajuster le stock en fonction de la différence
            $difference = $request->qte_appro - $ancienneQte;
            $this->stockService->updateStock(
                $station->id,
                $approvisionnement->produit_id,
                $difference
            );
        });

        return redirect()->route('approvisionnement.index')
            ->with('success', 'Approvisionnement mis à jour avec succès.');
    }

    public function destroy(string $id)
    {
        $station = Auth::user()->station;
        $approvisionnement = Approvisionnement::where('id', $id)
            ->where('station_id', $station->id)
            ->firstOrFail();

        $approvisionnement->delete();

        return redirect()->back()->with('success', 'Approvisionnement supprimé avec succès.');
    }

    public function download($format, Request $request)
    {
        $date_filter = $request->input('date_filter', Carbon::today()->toDateString());

        $approvisionnements = Approvisionnement::with(['produit.categorie'])
            ->where('station_id', auth()->user()->station->id)
            ->when($date_filter, function ($query) use ($date_filter) {
                $query->whereDate('date_approvisionnement', $date_filter);
            })
            ->orderByDesc('date_approvisionnement')
            ->get();

        $filename = "approvisionnements_" . $date_filter;

        switch ($format) {
            case 'pdf':
                $pdf = Pdf::loadView('approvisionnement.pdf', [
                    'approvisionnements' => $approvisionnements,
                    'date_filter' => $date_filter,
                    'station' => auth()->user()->station
                ]);
                return $pdf->stream("$filename.pdf");

            case 'excel':
                return Excel::download(
                    new ApprovisionnementsExport($approvisionnements),
                    "$filename.xls"
                );

            default:
                return back()->with('error', 'Format non supporté');
        }
    }


}