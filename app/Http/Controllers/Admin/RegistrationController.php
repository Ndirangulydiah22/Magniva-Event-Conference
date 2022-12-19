<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Registration;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Gate;

class RegistrationController extends Controller
{

    public function index()
    {
        // Check if the user is authorized to access this page
        abort_if(Gate::denies('register_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    
        // Fetch the list of events from the database
        $registration = Registration::paginate(20); // This will retrieve 10 events per page
    
        // Return the view with the events data
        return view('admin.register.index', compact('registration'));

    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Create a new registration record in the database
        $registration = new Registration();
        $registration->name = $request->name;
        $registration->email = $request->email;
        $registration->subject = $request->subject;
        $registration->message = $request->message;
        $registration->save();

        // Redirect to the registrations index page with a success message
        return redirect()->route('registrations.index')->with('success', 'Registration created successfully');

   
}
}