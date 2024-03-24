@extends('layouts.front-master')
@section('title', $event->meta_title)
@section('meta_description', $event->meta_description)
@section('image', asset('uploads/events/'.$event->image))
@section('content')
<!-- Breadcrumb Start -->

<section class="breadcrumbs">
    <div class="position-relative z-2 text-center">
        <h2 class="text-white breadcrumb-title">Events</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homes')}}"
                        class="text-white fw-semibold text-decoration-none"><i class="fa fa-home me-1"></i>Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Events</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->


<!-- Events Section Start -->

<section class="event-single">
    <div class="container">
        <div class="row rounded-3">
            <div class="col-lg-8">
                <div class="rounded-3 p-3 event-single-container">
                    <div class="event-single-img">
                        <img src="{{asset('uploads/events/' .$event->image)}}" alt="" class="w-100 rounded-3 mb-3">
                    </div>
                    <div class="event-single-details px-3 mb-5">
                        <h4 class="my-3 text-white">{{$event->title}}</h4>
                        <p>
                            {{$event->description}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 event-sidebar">
                <div class="event-side-details rounded-3 mb-4 p-3 bg-dark">
                    <div class="mb-4">
                        <p class="text-main mb-1"><i class="fa fa-clock-o me-1"></i> Time</p>
                        <p>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('h:i A')}}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-main mb-1"><i class="fa fa-calendar me-1"></i> Date</p>
                        <p>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d F Y')}}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-main mb-1"><i class="fa fa-map-marker me-1"></i>Venue</p>
                        <p class="text-capitalize">{{$event->venue}}</p>
                    </div>
                    <div class="share-event mb-3">
                        <ul class="social-share list-unstyled m-0">
                            <li><a href="https://www.facebook.com/sharer.php?u={{url('show-event/'.$event->event_slug)}}"
                                    target="_blank"><i class="fa fa-facebook-official"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{url('show-event/'.$event->event_slug)}}&text={!!$event->title!!}"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="upcoming-events rounded-3 p-3">
                    <h4>Upcoming Events</h4>
                    @foreach ($upcomingEvents as $event)
                    <div class="media border-bottom py-3">
                        <div class="d-flex align-items-start">
                            <div class="flex-shrink-0">
                                <img loading="lazy" width="64" height="64" src="{{asset('uploads/events/' .$event->image)}}" alt="img" />
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6><a href="{{url('event', ['event_slug' => $event->event_slug])}}" class="text-black fs-6 text-decoration-none">Creating Your At-Home
                                    {{$event->title}}</a>
                                </h6>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection