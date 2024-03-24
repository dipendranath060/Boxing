<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activeCategories = Category::where('is_active', '1')->get();
        return view('admin.news.create', compact('activeCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|min:5|max:100',
            'meta_title' => 'required|string|min:6|max:50',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'description' => 'required|string|min:10',
            'meta_description' => 'required|string|min:10|max:100',
            'image_alt' => 'required|string',
            'featured_image' => 'image|mimes:jpeg,png,gif|max:2048',
            'news_slug' => 'required|string',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
           
            //Save for news
            $news = new News();
            $news->title = $request->title;
            $news->description = $request->description;
            $news->meta_title = $request->meta_title;
            $news->meta_description = $request->meta_description;
            $news->image_alt = $request->image_alt;
            $news->fill($request->except('categories'));
            $slug = Str::slug($request->news_slug);
            $news->news_slug = $slug;

            if($request->hasFile('image'))
            {
                
                $file = $request->file('image');
                $fileName ='image_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/news/'), $fileName);
                $news->image = $fileName;
            }
            if($request->hasFile('featured_image'))
            { 
                $file = $request->file('featured_image');
                $fileName ='featured_image_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/news/'), $fileName);
                $news->featured_image = $fileName;
            }

            $news->save();
            $news->categories()->attach($request->input('categories'));

            return redirect()->route('news')->with('message', 'News Added Successfully...');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $news = News::findOrFail($id);

        if($news)
        {
            return view('admin.news.show', compact('news'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $activeCategories = Category::where('is_active', '1')->get();
        $news = News::findOrFail($id);

        if($news)
        {
            return view('admin.news.edit', compact('news', 'activeCategories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:100',
            'meta_title' => 'required|string|min:6|max:50',
            'image' => 'image|mimes:jpeg,png,gif|max:2048',
            'description' => 'required|string|min:10',
            'meta_description' => 'required|string|min:10|max:100',
            'image_alt' => 'required|string',
            'featured_image' => 'image|mimes:jpeg,png,gif|max:2048',
            'news_slug' => 'required|string',
        ]);

        //update news
            $news = News::findOrFail($id);

            if($news)
            {
                $news->title = $request->title;
                $news->description = $request->description;
                $news->meta_title = $request->meta_title;
                $news->meta_description = $request->meta_description;
                $news->image_alt = $request->image_alt;
                $news->fill($request->except('categories', 'image', 'featured_image'));
                $news->news_slug = Str::slug($request->news_slug);
    
      
                if ($request->hasFile('image')) {
                    $destination = public_path('uploads/news/') . $news->image;
                    if (File::exists($destination)) 
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('image');
                    $fileName = 'image_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/news/'), $fileName);
                    $news->image = $fileName;
                }
                
                if ($request->hasFile('featured_image')) {
                    $destination = public_path('uploads/news/') . $news->featured_image;
                    if (File::exists($destination)) 
                    {
                        File::delete($destination);
                    }
                    $file = $request->file('featured_image');
                    $fileName = 'featured_image_' . time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/news/'), $fileName);
                    $news->featured_image = $fileName;
                } 
    
                $news->update();
                if ($request->has('categories')) {
                    $categoryIds = $request->input('categories');
                    $news->categories()->syncWithoutDetaching($categoryIds);
                }
    
                return redirect()->route('news')->with('message', 'News Updated Successfully...');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $news = News::findOrFail($id);

        if(!$news)
        {
            return redirect()->route('news')->with('status', 'News Not Found...');
        }

        $destination = public_path('uploads/news/') .$news->image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }

        $destination = public_path('uploads/news/') .$news->featured_image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }

        $news->delete();

        return redirect()->route('news')->with('status', 'News Deleted Successfully...');
    }
}
