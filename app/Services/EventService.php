<?php

namespace App\Services;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventService
{
    public function createEvent($request)
    {
        $request->validate([
            'event' => 'required',
            'dates' => 'required',
        ]);

        return Event::create([
            'event' => $request['event'],
            'start_date' => Carbon::parse($request['dates'][0]),
            'end_date' => Carbon::parse( $request['dates'][1]),
        ]);
    }
}
