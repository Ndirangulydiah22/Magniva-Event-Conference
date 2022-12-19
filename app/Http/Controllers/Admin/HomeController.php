<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Event;

use Carbon\Carbon;


class HomeController
{
   

    public function index(){
        // Retrieve the number of events active, number of attendants per event, and number of events happening today
        $active_events = Event::count();
        $attendants = Attendance::count();
        $today_events = Event::whereDate('start_date', '=', Carbon::today())->count();
        $events = Event::all();
        $attendance = Attendance::all();
    
        // Pass the data to the view file
        return view('admin.home', [
            'active_events' => $active_events,
            'attendants' => $attendants,
            'today_events' => $today_events,
            'events' => $events,
            'attendance' => $attendance
        ]);
}
}