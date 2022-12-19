<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Amenity;
use App\Attendance;
use League\Csv\Writer;
use App\Http\Requests\MassDestroyAttendanceRequest;

use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;


class AttendanceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('attendance_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        
        $attendance = Attendance::paginate(20);
    
        return view('admin.attendance.index', compact('attendance'));
    }
    

    public function create()
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('attendance_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Fetch the list of events from the database
        $events = Attendance::all();

        // Return the form view with the events data
        return view('admin.attendance.create', ['events' => $events]);
    }


    public function store(Request $request)
    {

        abort_if(Gate::denies('attendance_store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // Validate form data
        $request->validate([
            'event_name' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'email',
            'designation' => 'string',
            'organization' => 'string',
            'country' => 'string',
            'city' => 'string',
    
        ]);
    
        // Create new attendee
        $attendee = new Attendance;
        $attendee->event_name = $request->event_name;
        $attendee->first_name = $request->first_name;
        $attendee->last_name = $request->last_name;
        $attendee->phone = $request->phone;
        $attendee->email = $request->email;
        $attendee->designation = $request->designation;
        $attendee->organization = $request->organization;
        $attendee->country = $request->country;
        $attendee->city = $request->city;
    
        $attendee->save();
    
        // redirect to attendance list
        return redirect()->route('admin.attendance.index')->with('success', 'Attendee added successfully.');
    }
    


    public function edit($id)
    {
        abort_if(Gate::denies('attendance_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        // Retrieve the Attendance object with the specified id
        $attendance = Attendance::find($id);
    
        // Return the view with the Attendance object data
        return view('admin.attendance.edit', ['attendance' => $attendance]);
    }
    

    public function update(Attendance $attendance, Request $request)
    {
        abort_if(Gate::denies('attendance_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        // Validate form data
        $request->validate([
            'event_name' => 'string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|numeric',
            'email' => 'email',
            'designation' => 'string',
            'organization' => 'string',
            'country' => 'string',
            'city' => 'string',
        ]);
    
        // Update attendee
        $attendance->event_name = $request->event_name;
        $attendance->first_name = $request->first_name;
        $attendance->last_name = $request->last_name;
        $attendance->phone = $request->phone;
        $attendance->email = $request->email;
        $attendance->designation = $request->designation;
        $attendance->organization = $request->organization;
        $attendance->country = $request->country;
        $attendance->city = $request->city;
    
        $attendance->save();
    
        // redirect to attendance list
        return redirect()->route('admin.attendance.index')->with('success', 'Attendee updated successfully.');
    }
    
    
    

    public function delete ($id)
    {
        abort_if(Gate::denies('attendance_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

       

        return redirect()->route('admin.attendance.index')->with('success', 'Attendee deleted successfully.');
    }

    // in app/Http/Controllers/AttendanceController.php

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
        $attendance = new Attendance;
        $attendance->event_name = $row[1]; 
        $attendance->first_name = $row[2]; 
        $attendance->last_name = $row[3]; 
        $attendance->phone = $row[4]; 
        $attendance->email = $row[5]; 
        $attendance->designation = $row[6]; 
        $attendance->organization = $row[7]; 
        $attendance->country = $row[8]; 
        $attendance->city = $row[9]; 
            // Save the attendance record to the database
    $attendance->save();
}

// Redirect the user with a success message
return redirect()->back()->with('success', 'The CSV was imported successfully!');
}

    
}
