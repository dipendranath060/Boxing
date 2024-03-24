@extends('layouts.master')
@section('title', 'Edit | Gallery')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('gallery')}}">Gallery</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Album</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Gallery Add Form -->
<div class="counter-container py-3">
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-lg-7">
                <div class="add-form bg-white p-4 rounded">
                    <h2 class="mb-5 section-title border-bottom pb-1">Edit a New Album</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{url('admin/update-gallery/'.$gallery->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="fs-5 mb-2">Title</label>
                            <input type="text" name="title" value="{{$gallery->title}}" id="title" class="w-100" placeholder="Enter album title..." required>
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="fs-5 mb-2">Album Slug</label>
                            <input type="text" name="album_slug" value="{{$gallery->album_slug}}" id="slug" class="w-100" placeholder="Enter album title..." required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="fs-5 mb-2">Description</label><br>
                            <textarea id="description" name="description" class="w-100" rows="5" placeholder="Enter Description...">{{$gallery->description}}</textarea>
                        </div>

                        <div class="mb-">
                            <label for="image" class="fs-5 mb-2">Thumbnail</label><br>
                            <input id="image" name="image" class="w-100" type="file"></input><br><br>
                                <img src="{{asset('uploads/gallery/'.$gallery->image)}}" width="100px" alt="existing image">
                        </div>

                        <div class="mb-5">
                            <label for="image" class="fs-5 mb-2">Select Images</label><br>
                            <input id="image" name="images[]" class="w-100" type="file" multiple>
                        </div>

                        <button type="submit" class="btn btn-primary mb-1">Update Album</button>
                        <button class="btn btn-danger mb-1" type="reset" onclick="reset_content()">Reset Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection