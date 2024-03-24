@extends('layouts.master')
@section('title', 'Add | Rules and Regulations')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    
<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
      <nav
        aria-label="breadcrumb"
        class="p-2 bg-white breadcrumb-main rounded">
        <ol class="breadcrumb m-0 justify-content-start">
          <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{route('rules')}}">Rules and Regulations</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Add Rules and Regulations
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Rules and Regulations Upload Form -->
  <div class="blog-container py-3">
    <div class="container">
      <div class="row mb-3 justify-content-center">
        <div class="col-lg-7">
          <div class="add-form bg-white p-4 rounded">
            <h2 class="mb-5 section-title border-bottom pb-1">
              Add Rules and Regulations
            </h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      <div>{{$error}}</div>
                  @endforeach
                </div>
            @endif
            <form action="{{route('add-rule')}}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="title" class="fs-5 mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{old('title')}}" class="w-100" placeholder="Enter blog title..." required />
              </div>
              
              <div class="mb-3">
                <label for="summernote" class="fs-5 mb-2"
                  >Description</label
                >
                <textarea
                  id="summernote"
                  class="bg-white"
                  name="body_content"
                >{{old('body_content')}}</textarea>
              </div>

              <button class="btn btn-primary mb-1">Add Rule and Regulation</button>
              <button class="btn btn-danger mb-1" type="reset" onclick="reset_content()"> Reset Content </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

<script>
    $('#summernote').summernote({
        placeholder: 'Enter body_content...', 
        // imageUploadURL: '/give url',
        tabsize: 2,
        height: 300
    });
    function reset_content() {
        $('#summernote').summernote('reset')
    }
</script>
@endsection
