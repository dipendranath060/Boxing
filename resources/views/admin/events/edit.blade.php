@extends('layouts.master')
@section('title', 'Edit | Event')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page"><a href="{{route('events')}}">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Event</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Event Add Form -->
<div class="counter-container py-3">
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-lg-7">
                <div class="add-form bg-white p-4 rounded">
                    <h2 class="mb-5 section-title border-bottom pb-1">Edit a Event</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif
                    <form action="{{url('admin/update-event/'.$event->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="fs-5 mb-2">Title</label>
                            <input type="text" name="title" value="{{$event->title}}" id="title" class="w-100" placeholder="Enter Event title..." required>
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="fs-5 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{$event->meta_title}}" id="meta_title" class="w-100" placeholder="Enter Event meta_title..." required>
                        </div>

                        <div class="mb-3">
                            <label for="event_slug" class="fs-5 mb-2">Event Slug</label>
                            <input type="text" name="event_slug" value="{{$event->event_slug}}" id="event_slug" class="w-100" placeholder="Enter Event title as slug..." required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="venue" class="fs-5 mb-2">Venue (Address)</label>
                            <input type="text" name="venue" value="{{$event->venue}}" id="venue" class="w-100" placeholder="Enter venue..." required>
                        </div>

                        <div class="mb-3">
                            <label for="venue" class="fs-5 mb-2">Event Start Date</label>
                            <input type="datetime-local" name="start_date" value="{{$event->start_date}}" id="datepicker" class="contact_input datepicker w-100" placeholder="Date" autocomplete="off" required="required"/>
                        </div>

                        <div class="mb-3">
                            <label for="venue" class="fs-5 mb-2">Event Expiry Date</label>
                            <input type="datetime-local" name="expiry_date" value="{{$event->expiry_date}}" id="datepicker" class="contact_input datepicker w-100" placeholder="Date" autocomplete="off" required="required"/>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="fs-5 mb-2">Description</label><br>
                            <textarea id="description" name="description" class="w-100" rows="5" placeholder="Enter Description...">{{$event->description}}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="fs-5 mb-2">Meta Description</label><br>
                            <textarea id="meta_description" name="meta_description" class="w-100" rows="5" placeholder="Enter meta_description...">{{$event->meta_description}}</textarea>
                        </div>

                        <div class="mb-5">
                            <label for="image" class="fs-5 mb-2">Image</label><br>
                            <input id="image" name="image" class="w-100" type="file"><br><br>
                                <img src="{{asset('uploads/events/'.$event->image)}}" width="80px" alt="existing_image">
                        </div>

                        <button type="submit" class="btn btn-primary mb-1">Update</button>
                        <button class="btn btn-danger mb-1" type="reset" onclick="reset_content()">Reset Content</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datepicker/jquery-ui.min.js') }}"></script>
<script>$('#datepicker').datepicker();</script>
@endsection