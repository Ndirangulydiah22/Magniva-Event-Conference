<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\EventsController;

use App\Amenity;
use App\Event;
use League\Csv\Writer;
use App\Http\Requests\MassDestroyAttendanceRequest;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;


class EventsController extends Controller
{
    public function index()
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        // Fetch the list of events from the database
        $events = Event::paginate(20); // This will retrieve 10 events per page
    
        // Return the view with the events data
        return view('admin.events.index', compact('events'));
    }
    


    public function create()
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Fetch the list of amenities from the database
        $amenities = Amenity::all();

        // Return the form view with the amenities data
        return view('admin.events.create', ['amenities' => $amenities]);
    }


    public function store(Request $request)
    {

        // Check if the user is authorized to access this page
        abort_if(Gate::denies('event_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Validate form data
        $request->validate([
            'event_name' => 'required|string',
            'minimum_guests' => 'required|numeric',
            'maximum_guests' => 'required|numeric',
            'event_location' => 'required|string',
            'venue' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // Create a new event
        $event = new Event;
        $event->event_name = $request->event_name;
        $event->minimum_guests = $request->minimum_guests;
        $event->maximum_guests = $request->maximum_guests;
        $event->event_location = $request->event_location;
        $event->venue = $request->venue;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->created_on = date("Y-m-d H:i:s");

        $event->save();

  

        // redirect to event list
        return redirect()->route('admin.events.index')->with('success', 'Event added successfully.');
    }


    public function edit($id)
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Retrieve the event object with the specified id
        $event = Event::find($id);

        // Fetch the list of amenities from the database
      

        // Return the view with the event and amenities data
        return view('admin.events.edit', ['event' => $event]);
    }


    public function update(Event $event, Request $request)
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('event_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Validate form data
        $request->validate([
            'event_name' => 'string', 
            'minimum_guests' => 'numeric',
            'maximum_guests' => 'numeric',
            'event_location' => 'string',
            'venue' => 'string',
            'start_date' => 'date',
            'end_date' => 'date',
        ]);

        // Update event data
        $event->event_name = $request->event_name;
        $event->minimum_guests = $request->minimum_guests;
        $event->maximum_guests = $request->maximum_guests;
        $event->event_location = $request->event_location;
        $event->venue = $request->venue;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;

        $event->save();

       

        // Redirect to the event list
        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }


    public function show(Event $event)
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Return the view with the event data
        return view('admin.event.show', ['event' => $event]);
    }

    public function delete($id)
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        // Retrieve the event from the database
        $event = Event::find($id);
    
        // Delete the event
        $event->delete();
    
        // Redirect to the event list
        return back()->with('success', 'Event deleted successfully.');
    }
    

    public function import(Request $request)
    {
      // Validate the file
      $request->validate([
          'file' => 'required|mimes:csv,txt'
      ]);
    
      // Get the file
      $file = $request->file('file');
    
      // Read the file into an array of rows
      $rows = array_map('str_getcsv', file($file));
    
      // Process each row
      foreach ($rows as $row) {
        $event = new Event;
        $event->event_name = $row[1]; 
        $event->minimum_guests = $row[2]; 
        $event->maximum_guests = $row[3]; 
        $event->event_location = $row[4]; 
        $event->venue = $row[5]; 
        $event->start_date = date('Y-m-d H:i:s', strtotime($row[5])); 
        $event->end_date = date('Y-m-d H:i:s', strtotime($row[6]));
        $event->save();
      }
    
      // Redirect the user with a success message
      return redirect()->back()->with('success', 'The CSV was imported successfully!');
    }
    
}

       

