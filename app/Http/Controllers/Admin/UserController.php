<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));

    }

     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect()->route('users')
                    ->with('message', 'New User Added Successfully....');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        if($user)
        {
            return view('admin.users.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::find($id);
        if($user)
        {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
    
            $user->update();
            return redirect()->route('users')
                        ->with('message', 'User Updated Successfully....');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users')->with('status', 'User not found.');
        }

        $user->delete();

        return redirect()->route('users')->with('status', 'User Deleted Successfully...');
    }
}

