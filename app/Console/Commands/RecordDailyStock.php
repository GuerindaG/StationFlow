<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use App\Models\DailyStockHistory;
use App\Models\Station;
use Carbon\Carbon;
use DB;

class RecordDailyStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stock:record-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Records the closing stock of each product for each station at the end of the day.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting daily stock recording...');

        // We record the closing stock for the day that just ended (yesterday)
        // or the current stock if run at the very end of the current day.
        $recordDate = Carbon::today()->subDay(); // Records closing stock for yesterday

        // Get all stations
        $stations = Station::all();

        foreach ($stations as $station) {
            // Get all current stocks for the station
            $stocks = Stock::where('station_id', $station->id)->get();

            if ($stocks->isEmpty()) {
                $this->warn("No current stock found for station: {$station->nom}. Skipping.");
                continue;
            }

            foreach ($stocks as $stock) {
                try {
                    // Update or create the daily stock history entry
                    DailyStockHistory::updateOrCreate(
                        [
                            'station_id' => $station->id,
                            'produit_id' => $stock->produit_id,
                            'date' => $recordDate->toDateString(),
                        ],
                        [
                            'closing_stock' => $stock->qte_actuelle,
                        ]
                    );
                } catch (\Exception $e) {
                    $this->error("Error recording stock for product ID {$stock->produit_id} at station {$station->nom} on {$recordDate->toDateString()}: " . $e->getMessage());
                }
            }
            $this->info("Stocks recorded for station: {$station->nom} for date {$recordDate->toDateString()}.");
        }

        $this->info('Daily stock recording finished.');
        return Command::SUCCESS;
    }
}
