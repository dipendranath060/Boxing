@extends('layouts.master')
@section('title', 'Edit | Board-Member')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('board-members')}}">Board-Members</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Board-Member</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Previous-Member Add Form -->
<div class="counter-container py-3">
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-lg-7">
                <div class="add-form bg-white p-4 rounded">
                    <h2 class="mb-5 section-title border-bottom pb-1">Edit a Board-Member</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{url('admin/update-board-member/'.$boardMember->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="fs-5 mb-2">Name</label>
                            <input type="text" name="name" value="{{$boardMember->name}}" id="name" class="w-100" placeholder="Enter Board member name..." required>
                        </div>

                        <div class="mb-3">
                            <label for="designation" class="fs-5 mb-2">Designation</label>
                            <input type="text" name="designation" value="{{$boardMember->designation}}" id="designation" class="w-100" placeholder="Enter designation..." required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="fs-5 mb-2">Description</label><br>
                            <textarea id="description" name="description" class="w-100" rows="5" placeholder="Enter Description...">{{$boardMember->description}}</textarea>
                        </div>

                        <div class="mb-5">
                            <label for="image" class="fs-5 mb-2">Image</label><br>
                            <input id="image" name="image" class="w-100" type="file"><br><br>
                                <img src="{{asset('uploads/board-members/'.$boardMember->image)}}" width="100px" alt="existing image">
                        </div>

                        <button type="submit" class="btn btn-primary mb-1">Update Board-Member</button>
                        <button class="btn btn-danger mb-1" type="reset" onclick="reset_content()">Reset Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection