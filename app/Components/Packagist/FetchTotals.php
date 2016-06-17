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
        $url = 'http://ikastmusikliv.dk/musiklivlager/jesper_api.php';
        $json = json_decode(file_get_contents($url));

        $totals = [
            'tickets' => $json->number_of_tickets,
            'friday' => $json->checkins_friday,
            'saturday' => $json->checkins_saturday,
            'door' => $json->checkins_friday_doorsale + $json->checkins_saturday_doorsale,
            'food' => $json->checkins_saturday_dinner,
        ];

        event(new TotalsFetched($totals));
    }
}
