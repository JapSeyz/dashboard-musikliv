<?php

namespace App\Components\LastFm;

use App\Components\LastFm\Events\NothingPlaying;
use App\Components\LastFm\Events\TrackIsPlaying;
use Illuminate\Console\Command;
use Spatie\NowPlaying\NowPlaying;

class FetchCurrentTrack extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:lastfm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch the currently playing track from last.fm.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastFm = new NowPlaying(config('last-fm.api_key'));

        foreach (config('last-fm.users') as $userName) {
            $currentTrack = $lastFm->getTrackInfo($userName);

            $currentTrack['trackName'] = str_limit($currentTrack['trackName'], 35);
            if (\Storage::disk('public')->exists('img/artwork/' . str_slug($currentTrack['artist']) . '.jpg')) {
                $currentTrack['artwork'] = '/img/artwork/' . str_slug($currentTrack['artist']) . '.jpg';
            }

            if ($currentTrack) {
                event(new TrackIsPlaying($currentTrack, $userName));

                return;
            }
        }

        event(new NothingPlaying());
    }
}
