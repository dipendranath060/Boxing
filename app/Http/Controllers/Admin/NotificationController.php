<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::paginate(10);
        return view('admin.pop-up.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pop-up.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:100',
            'image' => 'image|mimes:jpeg,png,gif|max:2048'
        ]);

        $notification = new Notification();
        $notification->title = $request->title;
        $notification->link = $request->link;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads/notifications/'), $fileName);
            $notification->image = $fileName;
        }

        $notification->save();

        return redirect()->route('notifications')
                    ->with('message', 'Notification Added Successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notification = Notification::findOrFail($id);
        if($notification)
        {
            return view('admin.pop-up.edit', compact('notification'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:100',
            'image' => 'image|mimes:jpeg,png,gif|max:2048'
        ]);

        $notification = Notification::find($id);
        
        if($notification)
        {
            $notification->title = $request->title;
            $notification->link = $request->link;
    
            if($request->hasFile('image'))
            {
                $destination = public_path('uploads/notifications/') .$notification->image;
                if (File::exists($destination)) 
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName = time(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('uploads/notifications/'), $fileName);
                $notification->image = $fileName;
            }
                $notification->update();
    
                return redirect()->route('notifications')
                            ->with('message', 'Notification Updated Successfully...');
        }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return redirect()->route('notifications')->with('status', 'notification not found.');
        }

        $destination = public_path('uploads/notifications/') . $notification->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $notification->delete();

        return redirect()->route('notifications')->with('status', 'Notification Deleted Successfully...');
    }
}
