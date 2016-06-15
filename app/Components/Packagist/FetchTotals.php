<?php

namespace App\Components\Packagist;

use App\Components\Packagist\Events\TotalsFetched;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Spatie\Packagist\Packagist;

class FetchTotals extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:packagist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the total amount of downloads of packages for a vendor.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $totals = [
            'sold' => 200,
            'daily' => 100,
            'total' => 50,
        ];

        event(new TotalsFetched($totals));
    }
}
