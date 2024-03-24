@extends('layouts.master')
@section('title', 'Add | Milestone')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('milestones')}}">Milestone</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Milestone</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Milestone Add Form -->
<div class="counter-container py-3">
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-lg-7">
                <div class="add-form bg-white p-4 rounded">
                    <h2 class="mb-5 section-title border-bottom pb-1">Add a Milestone</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{route('add-milestone')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="fs-5 mb-2">Title</label>
                            <input type="text" id="title" value="{{old('title')}}" name="title" class="w-100" autocomplete="off" placeholder="Enter Milestone title..." required>
                        </div>

                        <div class="mb-5">
                            <label for="achievements" class="fs-5 mb-2">Achievements</label><br>
                            <input id="achievements" value="{{old('achievements')}}" name="achievements" class="w-100" type="text" autocomplete="off" placeholder="Enter Achievements..."
                                required>
                        </div>

                        <button class="btn btn-primary mb-1" type="submit">Add Milestone</button>
                        <button class="btn btn-danger mb-1" type="reset" onclick="reset_content()">Reset Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
