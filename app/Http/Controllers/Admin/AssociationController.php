<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Association;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AssociationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $associations = Association::paginate(10);
        return view('admin.member-associations.index', compact('associations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.member-associations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3|max:100',
            'image' => 'image|mimes:jpeg,png,gif|max:2048'
        ]);

        $association = new Association();
        $association->title = $request->title;
        $association->description = $request->description;
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file -> move(public_path('uploads/member-association/'), $fileName);
            $association->image = $fileName;
        }

        $association->save();
        return redirect()->route('associations')
                    ->with('message', 'Member Association Added Successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $association = Association::findOrFail($id);
        if($association)
        {
            return view('admin.member-associations.show', compact('association'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $association = Association::find($id);
        if($association)
        {
            return view('admin.member-associations.edit', compact('association'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:50',
            'description' => 'required|string|min:3|max:100',
            'image' => 'image|mimes:jpeg,png,gif|max:2048'
        ]);

        $association = Association::find($id);
        if($association)
        {
            $association->title = $request->title;
            $association->description = $request->description;
            if ($request->hasFile('image'))
            {
                $destination = public_path('uploads/member-association/') .$association->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName = time(). '.' .$file->getClientOriginalExtension();
                $file -> move(public_path('uploads/member-association/'), $fileName);
                $association->image = $fileName;
            }
    
            $association->update();
            return redirect()->route('associations')
                        ->with('message', 'Member Association Updated Successfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $association = Association::find($id);
        if(!$association)
        {
            return redirect()->route('associations')->with('status', 'Member Association not found.');
        }
        $destination = public_path('uploads/member-association/') . $association->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $association->delete();

        return redirect()->route('associations')->with('status', 'Member Association Deleted Successfully...');
    }
    
}
