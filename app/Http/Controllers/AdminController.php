<?php

namespace App\Http\Controllers;

use App\Components\Notification\Events\NotificationFetched;
use Illuminate\Http\Request;
use Storage;

class AdminController extends Controller
{
    public function index()
    {
        $pusherKey = config('broadcasting.connections.pusher.key');

        return view('admin')->with(compact('pusherKey'));
    }

    public function store(Request $request)
    {
        $notifications = [
            0 => 'a3',
            1 => 'b3',
            2 => 'c3',
            3 => 'd3'];

        if (!Storage::exists('latest_notification')) {
            Storage::put('latest_notification', 'd3');
        }

        $file = Storage::get('latest_notification');
        
        if($file != 3) {
            $grid = $notifications[ $file + 1 ];
            $file = $file +1;
        } else {
            $grid = $notifications[0];
            $file = 0;
        }
        
        Storage::put('latest_notification', $file);

        $title = $request->input('title');
        $message = $request->input('message');
        
        event(new NotificationFetched($grid, $title, $message));

        return redirect()->back();
    }
}
