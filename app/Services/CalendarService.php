<?php

namespace App\Services;

use App\Models\Calendar;
use Carbon\CarbonPeriod;

class CalendarService
{
    public static function getEvents()
    {
        return Calendar::with('event')
            ->get()
            ->map(function ($data) {
                return [
                    'title' => $data->event->event,
                    'date' => $data->days->toDateString(),
                ];
            });
    }

    public function addDatesToEvent($request, $id)
    {
        $recurrences = $request->recurrences;
        $periods = CarbonPeriod::create($request->dates[0], $request->dates[1]);

        foreach ($periods as $period) {
            Calendar::create([
                'event_id' => $id,
                'days' => $this->recurrence($period, $recurrences),
            ]);
        }
    }

    public function recurrence($date, $recurrences = [])
    {
        if ($recurrences && $recurrences[0] && $date->isMonday()) {
            return $date;
        } elseif ($recurrences && $recurrences[1] && $date->isTuesday()) {
            return $date;
        } elseif ($recurrences && $recurrences[2] && $date->isWednesday()) {
            return $date;
        } elseif ($recurrences && $recurrences[3] && $date->isThursday()) {
            return $date;
        } elseif ($recurrences && $recurrences[4] && $date->isFriday()) {
            return $date;
        } elseif ($recurrences && $recurrences[5] && $date->isSaturday()) {
            return $date;
        } elseif ($recurrences && $recurrences[6] && $date->isSunday()) {
            return $date;
        } else {
            return 0;
        }
    }
}
