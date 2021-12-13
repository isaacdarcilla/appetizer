<?php

namespace App\Http\Controllers;

use App\Services\CalendarService;
use App\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    private $eventService;
    private $calendarService;

    public function __construct(EventService $eventService, CalendarService $calendarService)
    {
        $this->eventService = $eventService;
        $this->calendarService = $calendarService;
    }

    public function index(): Response
    {
        return Inertia::render('Calendar', [
            'calendars' =>  CalendarService::getEvents()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $id = $this->eventService->createEvent($request)->id;
        $this->calendarService->addDatesToEvent($request, $id);

        return redirect()->back();
    }
}
