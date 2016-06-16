<?php

namespace App\Components\RainForecast;

use App\Components\RainForecast\Events\ForecastFetched;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class FetchRainForecast extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:rain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the rain forecast.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cityId = 2619426;
        $OWApi = env('OPENWEATHER_API_KEY');

        $responseBody = (string) (new Client())
                ->get("http://api.openweathermap.org/data/2.5/forecast/weather?id={$cityId}&APPID={$OWApi}")
                ->getBody();

        $forecast = $this->getForecastFromResponseBody($responseBody);

        event(new ForecastFetched($forecast));
    }

    public function getForecastFromResponseBody(string $responseBody): array
    {
        $forecastItems = json_decode($responseBody, true)['list'];

        return collect($forecastItems)
            ->map(function ($forecastItem) {
                
                $chanceOfRain = 0;
                
                if(array_key_exists('3h', $forecastItem['rain'])) {
                    $chanceOfRain = (int) ($forecastItem[ 'rain' ][ '3h' ] * 100);
                }
                
                $carbon = $this->getCarbonFromTime($forecastItem['dt']);

                $minutes = $carbon->diffInMinutes();

                if ($carbon->isPast()) {
                    $minutes *= -1;
                }

                return compact('chanceOfRain', 'minutes');
            })
            ->take(2)
            ->values()
            ->toArray();
    }

    public function getCarbonFromTime(int $time) : Carbon
    {
        $dateTime = Carbon::createFromTimestamp($time);

        if (starts_with($time, '00') && Carbon::now()->hour == 23) {
            $dateTime->addDay();
        }

        return $dateTime;
    }
}
