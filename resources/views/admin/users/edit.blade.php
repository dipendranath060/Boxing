@extends('layouts.master')
@section('title', 'Edit | User')
@section('content')

 <!-- Breadcrumb -->
 <div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('users')}}">User</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
            </ol>
        </nav>
    </div>
</div>

<!-- user Add Form -->
<div class="counter-container py-3">
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-lg-7">
                <div class="add-form bg-white p-4 rounded">
                    <h2 class="mb-5 section-title border-bottom pb-1">Edit a User</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{url('admin/update-user/'.$user->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="fs-5 mb-2">Name</label>
                            <input type="text" value="{{$user->name}}" name="name" id="name" class="w-100" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="fs-5 mb-2">Email</label>
                            <input type="email" value="{{$user->email}}" name="email" id="email" class="w-100" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="fs-5 mb-2">Password</label>
                            <input type="password" name="password" id="password" class="w-100" required>
                        </div>

                        <button type="submit" class="btn btn-primary mb-1">Update User</button>
                        <button class="btn btn-danger mb-1" type="reset" onclick="reset_content()">Reset Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection