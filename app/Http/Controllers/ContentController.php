<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function create()
    {
        return view('admin.content'); // Return the form view
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'content' => 'required|string',
    ]);

    // Save the image to public/images
    $imagePath = $request->file('image')->move(public_path('images'), $request->file('image')->getClientOriginalName());

    Content::create([
        'title' => $request->title,
        'image' => $request->file('image')->getClientOriginalName(), // Just save the file name
        'content' => $request->content,
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'Content created successfully!');
}
}
