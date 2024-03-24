<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MedicalTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalMembers = MedicalTeam::paginate(10);
        return view('admin.medical-members.index', compact('medicalMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.medical-members.create');
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

        $medicalMember = new MedicalTeam();
        $medicalMember->name = $request->name;
        $medicalMember->designation = $request->designation;
        $medicalMember->description = $request->description;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads/medical-members/'), $fileName);
            $medicalMember->image = $fileName;
        }

        $medicalMember->save();
        return redirect()->route('medical-members')
                    ->with('message', 'Medical-Member Added Successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $medicalMember = MedicalTeam::find($id);
        if($medicalMember)
        {
            return view('admin.medical-members.edit', compact('medicalMember'));
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

        $medicalMember = MedicalTeam::find($id);
        if($medicalMember)
        {
            $medicalMember->name = $request->name;
            $medicalMember->designation = $request->designation;
            $medicalMember->description = $request->description;
    
            if($request->hasFile('image'))
            {
                $destination = public_path('uploads/medical-members/') .$medicalMember->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName = time(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('uploads/medical-members/'), $fileName);
                $medicalMember->image = $fileName;
            }
    
            $medicalMember->update();
            return redirect()->route('medical-members')
                        ->with('message', 'Medical-Member Updated Successfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medicalMember = MedicalTeam::find($id);

        if (!$medicalMember) {
            return redirect()->route('medical-members')->with('status', 'Medical Member not found.');
        }

        $destination = public_path('uploads/medical-members/') . $medicalMember->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $medicalMember->delete();

        return redirect()->route('medical-members')->with('status', 'Medical Member Deleted Successfully...');
    }
}
