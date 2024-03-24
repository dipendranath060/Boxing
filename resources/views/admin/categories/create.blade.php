@extends('layouts.master')
@section('title', 'Add | Category')
@section('content')
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}"">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{route('categories')}}">Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Add Category</li>
            </ol>
          </nav>                  
    </div>
</div>
<div class="container">
    <div class="row mb-3 justify-content-center">
        <div class="col-lg-7">
            <div class="add-form bg-white p-4 rounded">
                <h2 class="mb-5 section-title border-bottom pb-1">Add a category</h2>
                @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>
                            {{$error}}
                        </div>
                    @endforeach
                </div>
                @endif
                <form action="{{url('admin/add-category')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="fs-5 mb-2">Name</label>
                        <input type="text" name="name" value="{{old('name')}}" id="name" class="w-100" placeholder="Enter category name..." required>
                    </div>

                    <div class="mb-5">
                        <label for="is_active" class="fs-5 mb-2">Status</label><br>
                        <input type="checkbox" name="is_active" value="1" {{ old('status') ? 'checked' : '' }}> active
                    </div>
                    <button class="btn btn-primary mb-1" type="submit">Add Category</button>
                    <button class="btn btn-danger mb-1" type="reset">Reset Content</button>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection