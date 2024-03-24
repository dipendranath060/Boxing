<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Gallery::paginate(10);
        return view('admin.gallery.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:40',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,gif|max:2048',
            'album_slug' => 'required',
            'description' => 'required|min:4'
        ]);

        $gallery = new Gallery();
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->album_slug =Str::slug ($request->album_slug);
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $fileName ='image_' . time(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('uploads/gallery/'), $fileName);
            $gallery->image = $fileName;
        }

        $uploadedImages = [];
        if ($request->hasFile('images'))
        {
            foreach ($request->file('images') as $value) {
            $fileName ='images_' . time() . '_' . $value->getClientOriginalName();
            $value->move(public_path('uploads/gallery/'), $fileName);
            $uploadedImages[] = $fileName;
            }
        }

        $gallery->images = json_encode($uploadedImages);
        $gallery->save();

        return redirect()->route('gallery')
                    ->with('message', 'New Ablum Added Successfully...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::find($id);
        if($gallery)
        {
            return view('admin.gallery.edit', compact('gallery'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:40',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'images.*' => 'image|mimes:jpeg,png,gif|max:2048',
            'album_slug' => 'required',
            'description' => 'required|min:4'
        ]);

        $gallery = Gallery::findOrFail($id);
        if ($gallery) {
            $gallery->title = $request->title;
            $gallery->description = $request->description;
            $gallery->album_slug = Str::slug($request->album_slug);

            // Update Thumbnail Image
            if ($request->hasFile('image')) {
                $destination = public_path('uploads/gallery/') . $gallery->image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
                $file = $request->file('image');
                $fileName ='image_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/gallery/'), $fileName);
                $gallery->image = $fileName;
            }

            // Handle multiple images update
            $uploadedImages = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $value) {
                    $fileName ='image_' . time() . '_' . $value->getClientOriginalName();
                    $value->move(public_path('uploads/gallery/'), $fileName);
                    $uploadedImages[] = $fileName;
                }

                // Decode existing images
                $existingImages = json_decode($gallery->images);

                // Delete any images that are removed
                foreach ($existingImages as $existingImage) {
                    if (!in_array($existingImage, $uploadedImages)) {
                        if (file_exists(public_path('uploads/gallery/' . $existingImage))) {
                            unlink(public_path('uploads/gallery/' . $existingImage));
                        }
                    }
                }

                // Update images field
                $gallery->images = json_encode($uploadedImages);
            }

            $gallery->save();

            return redirect()->route('gallery')->with('message', 'Album Updated Successfully...');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        if ($gallery) {
            // Delete thumbnail image
            $destination = public_path('uploads/gallery/') . $gallery->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            // Delete multiple images
            $images = json_decode($gallery->images);
            foreach ($images as $image) {
                $destination = public_path('uploads/gallery/') . $image;
                if (File::exists($destination)) {
                    File::delete($destination);
                }
            }

            // Delete the gallery entry from the database
            $gallery->delete();

            return redirect()->route('gallery')->with('status', 'Album Deleted Successfully...');
        }

        return redirect()->route('gallery')->with('status', 'Album not found!');
    }
}
