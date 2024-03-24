<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:100',
            'meta_title' => 'required|string|min:4|max:70',
            'venue' => 'required|string|max:50',
            'description' => 'required|string|min:10',
            'meta_description' => 'required|string|min:10',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'event_slug' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'expiry_date' => 'required|date|after:start_date',
        ]);

        $event = new Event();
        $event->title = $request->title;
        $event->meta_title = $request->meta_title;
        $event->venue = $request->venue;
        $event->start_date = $request->start_date;
        $event->expiry_date = $request->expiry_date;
        $event->description = $request->description;
        $event->meta_description = $request->meta_description;
        $event->event_slug = Str::slug($request->event_slug);

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads/events/'), $fileName);
            $event->image = $fileName;
        }

        $event->save();
        return redirect()->route('events')->with('message', 'Event Added Successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::find($id);
        if($event)
        {
            return view('admin.events.edit', compact('event'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:100',
            'meta_title' => 'required|string|min:4|max:70',
            'venue' => 'required|string|max:50',
            'description' => 'required|string|min:10',
            'meta_description' => 'required|string|min:10',
            'event_slug' => 'required|string',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'start_date' => 'required|date|after_or_equal:today',
            'expiry_date' => 'required|date|after:start_date',
        ]);

        $event = Event::find($id);
        if($event)
        {
            $event->title = $request->title;
            $event->meta_title = $request->meta_title;
            $event->venue = $request->venue;
            $event->start_date = $request->start_date;
            $event->expiry_date = $request->expiry_date;
            $event->description = $request->description;
            $event->meta_description = $request->meta_description;
            $event->event_slug = Str::slug($request->event_slug);
    
            if($request->hasFile('image'))
            {
                $destination = public_path('uploads/events/') .$event->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName = time(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('uploads/events/'), $fileName);
                $event->image = $fileName;
            }
    
            $event->update();
            return redirect()->route('events')->with('message', 'Event Updated Successfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('events')->with('status', 'Event not found.');
        }

        $destination = public_path('uploads/events/') . $event->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $event->delete();

        return redirect()->route('events')->with('status', 'Event Deleted Successfully...');
    }
}
