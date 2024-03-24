<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.create');
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

        $banner = new Banner;
        $banner->title = $request->title;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName = time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners/'), $fileName);
            $banner->image = $fileName;
        }

        $banner->save();

        return redirect()->route('banners')
                    ->with('message', 'Banner Added Successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::find($id);
        if($banner)
        {
            return view('admin.banners.edit', compact('banner'));
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

        $banner = Banner::find($id);
        if($banner)
        {
            $banner->title = $request->title;
    
            if($request->hasFile('image'))
            {
                $destination = public_path('uploads/banners/') .$banner->image;
                if(File::exists($destination))
                {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName = time(). '.' .$file->getClientOriginalExtension();
                $file->move(public_path('uploads/banners/'), $fileName);
                $banner->image = $fileName;
            }
    
            $banner->update();
    
            return redirect()->route('banners')
                        ->with('message', 'Banner Updated Successfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return redirect()->route('banners')->with('status', 'Banner not found.');
        }

        $destination = public_path('uploads/banners/') . $banner->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }

        $banner->delete();

        return redirect()->route('banners')->with('status', 'Banner Deleted Successfully...');
    }
}
