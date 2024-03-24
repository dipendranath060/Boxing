<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::paginate(10);
        return view('admin.documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:100',
            'description' => 'required|string|min:4|max:100',
            'document' => 'required|mimes:pdf|max:2048',
        ]);

        $document = new Document();
        $document->title = $request->title;
        $document->description = $request->description;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $originalFileName = $file->getClientOriginalName();
            $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
    
            $path = $file->storeAs('public/documents', $fileNameToStore);
            $document->document = $path;
        }
    
        $document->save();

        return redirect()->route('documents')->with('message', 'Document Added Successfully...');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $document = Document::findOrFail($id);
        
        if($document)
        {
            return view('admin.documents.edit', compact('document'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|min:4|max:100',
            'description' => 'required|string|min:4|max:100',
            'document' => 'required|mimes:pdf|max:2048',
        ]);

        $document = Document::findOrFail($id);
        if($document)
        {
            $document->title = $request->title;
            $document->description = $request->description;
    
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                if(Storage::exists($document->document))
                {
                    Storage::delete($document->document);
                }
                $originalFileName = $file->getClientOriginalName();
                $fileName = pathinfo($originalFileName, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
        
                $path = $file->storeAs('public/documents', $fileNameToStore);
                $document->document = $path;
            }
        
            $document->update();
    
            return redirect()->route('documents')->with('message', 'Document Updated Successfully...');        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = Document::findOrFail($id);

        if(!$document)
        {
            return redirect()->route('documents')->with('status', 'Document Not Found...');
        }

            if(Storage::exists($document->document))
            {
                Storage::delete($document->document);
            }

        $document->delete();
        return redirect()->route('documents')->with('status', 'Document Deleted Successfully...');
    }

    public function download(string $id)
    {
        $document = Document::findOrFail($id);

        if ($document) {
            $filePath = storage_path('app/' . $document->document);
    
            // Sanitize the title to remove problematic characters
            $sanitizedTitle = preg_replace('/[\/\\\\]/', '-', $document->title);
    
            return response()->download($filePath, $sanitizedTitle . '.pdf', [], 'inline');
        }
    }
}
