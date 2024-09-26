<?php

namespace App\Http\Controllers;

use App\Models\Content; // Import the Content model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $contents = Content::all(); // Fetch all contents
        return view('admin.dashboard', compact('contents')); // Pass contents to the view
    }
}
