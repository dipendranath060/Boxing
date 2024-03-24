<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FieldCoordinator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FieldCoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinatorMembers = FieldCoordinator::paginate(10);
        return view('admin.field-coordinators.index', compact('coordinatorMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.field-coordinators.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'designation' => 'required|string|max:50',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'description' => 'string|min:10|max:75',
        ]);

        $coordinatorMember = new FieldCoordinator();
        $coordinatorMember->name = $request->name;
        $coordinatorMember->designation = $request->designation;
        $coordinatorMember->description = $request->description;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads/field-coordinators/'), $fileName);
            $coordinatorMember->image = $fileName;
        }

        $coordinatorMember->save();
        return redirect()->route('coordinator-members')
                    ->with('message', 'Field Coordinator Added Successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coordinatorMember = FieldCoordinator::find($id);
        if($coordinatorMember)
        {
            return view('admin.field-coordinators.edit', compact('coordinatorMember'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'designation' => 'required|string|max:20',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'description' => 'string|min:10|max:75',
        ]);

        $coordinatorMember = FieldCoordinator::find($id);
        if($coordinatorMember)
        {
            $coordinatorMember->name = $request->name;
            $coordinatorMember->designation = $request->designation;
            $coordinatorMember->description = $request->description;
    
            if($request->hasFile('image'))
            {
                $destination = public_path('uploads/field-coordinators/') .$coordinatorMember->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName = time(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('uploads/field-coordinators/'), $fileName);
                $coordinatorMember->image = $fileName;
            }
    
            $coordinatorMember->update();
            return redirect()->route('coordinator-members')
                        ->with('message', 'Field Coordinator Member Updated Successfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coordinatorMember = FieldCoordinator::find($id);

        if (!$coordinatorMember) {
            return redirect()->route('coordinator-members')->with('status', 'Field Coordinator Member not found.');
        }

        $destination = public_path('uploads/field-coordinators/') . $coordinatorMember->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $coordinatorMember->delete();

        return redirect()->route('coordinator-members')->with('status', 'Field Coordinator Member Deleted Successfully...');
    }
}
