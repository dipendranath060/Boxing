<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BoardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BoardMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boardMembers = BoardMember::paginate(10);
        return view('admin.board-members.index', compact('boardMembers'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.board-members.create');
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

        $boardMember = new BoardMember();
        $boardMember->name = $request->name;
        $boardMember->designation = $request->designation;
        $boardMember->description = $request->description;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads/board-members/'), $fileName);
            $boardMember->image = $fileName;
        }

        $boardMember->save();
        return redirect()->route('board-members')
                    ->with('message', 'Board-Member Added Successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $boardMember = BoardMember::find($id);
        if($boardMember)
        {
            return view('admin.board-members.edit', compact('boardMember'));
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

        $boardMember = BoardMember::find($id);
        if($boardMember)
        {
            $boardMember->name = $request->name;
            $boardMember->designation = $request->designation;
            $boardMember->description = $request->description;
    
            if($request->hasFile('image'))
            {
                $destination = public_path('uploads/board-members/') .$boardMember->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName = time(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('uploads/board-members/'), $fileName);
                $boardMember->image = $fileName;
            }
    
            $boardMember->update();
            return redirect()->route('board-members')
                        ->with('message', 'Board-Member Updated Successfully...');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $boardMember = BoardMember::find($id);

        if (!$boardMember) {
            return redirect()->route('board-members')->with('status', 'Previous Member not found.');
        }

        $destination = public_path('uploads/board-members/') . $boardMember->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $boardMember->delete();

        return redirect()->route('board-members')->with('status', 'Board Member Deleted Successfully...');
    }
}
