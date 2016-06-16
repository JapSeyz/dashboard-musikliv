<?php

namespace App\Components\Livecam;

use App\Components\Livecam\Events\ImageFetched;
use Illuminate\Console\Command;

class FetchImage extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch new stillimage';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = 'http://test.ikastmusikliv.dk/webcam/image.php';

        // Get Image Data
        $data = file_get_contents($url);

        // Save the image
        file_put_contents(public_path('img/livecam.jpg'), $data);

        event(new ImageFetched());
    }
}
