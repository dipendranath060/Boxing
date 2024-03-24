<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rules;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rules = Rules::paginate(10);
        return view('admin.rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'body_content' => 'required|min:4|string'
        ]);

        $rules = new Rules();
        $rules->title = $request->title;
        $rules->body_content = $request->body_content;

        $rules->save();

        return redirect()->route('rules')
                        ->with('message', 'Rules and Regulations Added Successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rule = Rules::findOrFail($id);
        if($rule)
        {
            return view('admin.rules.show', compact('rule'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rules = Rules::findOrFail($id);

        if($rules)
        {
            return view('admin.rules.edit', compact('rules'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'body_content' => 'required|min:4|string'
        ]);

        $rules = Rules::findOrFail($id);

        if($rules)
        {
            $rules->title = $request->title;
            $rules->body_content = $request->body_content;
    
            $rules->save();
    
            return redirect()->route('rules')
                            ->with('message', 'Rules and Regulations Updated Successfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rules = Rules::findOrFail($id);

        if(!$rules)
        {
            return redirect()->route('rules')
                            ->with('status', 'Rules and Regulations not found.. ');
        }

        $rules->delete();

        return redirect()->route('rules')
                            ->with('status', 'Rules and Regulations Deleted Successfully... ');
    }
}
