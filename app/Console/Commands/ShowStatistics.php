<?php

namespace App\Console\Commands;

use App\Models\Item;
use Illuminate\Console\Command;

class ShowStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //php artisan make:command ShowStatistics
    protected $signature = 'statistics:show {--name=count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'display the statistics';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ( $this->option('name') == "count"){
            $items_count = Item::count();
            return $this->info("Products Count: {$items_count}!");
        }
        if ( $this->option('name') == "average") {
            $avgStar = Item::avg('price');
            return $this->info("Price average: {$avgStar}!");
        }
        if ( $this->option('name') == "max_url") {
            $maxPricesTotals = Item::getMaxTotalPriceForUrl();
            return $this->info("Max total price URL: {$maxPricesTotals}!");
        }
        if ( $this->option('name') == "this_month_price_total"){
            $pricesTotalsThisMonth = Item::getTotalPriceThisMonth();
            return $this->info("Total Prices this month: {$pricesTotalsThisMonth}!");

        }

    }
}
