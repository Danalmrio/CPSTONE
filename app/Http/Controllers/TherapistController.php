<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Content; // Ensure the Content model is imported
use Illuminate\Support\Facades\Auth;

class TherapistController extends Controller
{
    public function index()
    {
        // Fetch all contents or customize to fetch therapist-specific content if necessary
        $contents = Content::all(); // Adjust this query to your needs

        // Pass the contents to the view
        return view('therapist.dashboard', compact('contents'));
    }

    public function appIndex()
    {
        // Fetch the appointments where the logged-in therapist is assigned
        $appointments = Appointment::where('therapistID', Auth::id())->with('patient')->get();

        // Pass appointments to the view
        return view('therapist.appointments', compact('appointments'));
    }

    public function schedule()
    {
        // Logic for displaying the schedule page
        return view('therapist.schedule');
    }

    public function viewSession()
    {
        // Logic for viewing session details
        return view('therapist.view-session');
    }

    public function progress()
    {
        // Logic for showing the progress page
        return view('therapist.progress');
    }
}
