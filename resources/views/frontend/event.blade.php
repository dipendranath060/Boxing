@extends('layouts.front-master')
@section('title', 'NPBC | Events')
@section('image', asset('assets/images/logo.jpg'))
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

<section class="events">
    <div class="container">
        <div class="section-heading mb-5 text-center">
            <h6 class="section-subtitle mb-2"><span>EVENTS</span></h6>
            <h2 class="section-title mb-4">Upcoming events for positive social change</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($upcomingEvents as $event)
            <div class="col-lg-5 mb-5">
                <div class="event-card">
                    <div class="event-image">
                        <a href="{{url('event', ['event_slug' => $event->event_slug])}}">
                            <img src="{{asset('uploads/events/' .$event->image)}}" alt="" class="w-100 rounded-3">
                        </a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-11">
                            <div class="event-details bg-white p-4 rounded-3">
                                <div class="event-venue pb-2 d-flex flex-column flex-sm-row">
                                    <div>
                                        <i class="fa fa-map-marker text-main me-1"></i><span
                                            class="me-2">{{$event->venue}}</span>
                                    </div>
                                    <div>
                                        <i class="fa fa-clock-o text-main me-1"></i><span>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('h:i A')}}</span>
                                    </div>
                                </div>
                                <h5 class="my-3 event-title fw-bold"><a href="{{url('event', ['event_slug' => $event->event_slug])}}"
                                        class="text-decoration-none fs-5">{{Str::limit($event->title, 30)}}</a></h5>
                                <p class="event-description">
                                    {{Str::limit($event->description, 85)}}
                                </p>
                                <a href="{{url('event', ['event_slug' => $event->event_slug])}}" class="text-main text-decoration-none">READ MORE <i
                                        class="fa fa-angle-right ms-1"></i></a>
                                <div class="event-date">
                                    <p class="mb-0">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d M')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$upcomingEvents->links()}}
    </div>
</section>

<!-- Events Section End -->

<section class="prev-events">
    <div class="container">
        <div class="section-heading mb-5 text-center">
            <h6 class="section-subtitle mb-2"><span>PAST EVENTS</span></h6>
            <h2 class="section-title mb-4">Engaging events for positive social change</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($previousEvents as $event)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="prev-event-card p-2 rounded-2 bg-white">
                    <div class="prev-event-card-img">
                        <img src="{{asset('uploads/events/'.$event->image)}}" alt="event" class="w-100 rounded-2">
                    </div>
                    <div class="prev-event-card-des p-2">
                        <h6 class="prev-event-card-title"><a href="{{url('event', ['event_slug' => $event->event_slug])}}"
                                class="text-decoration-none">{{Str::limit($event->title, 25)}}</a></h6>
                        <div class="d-flex justify-content-between">
                            <p class="text-dark">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('d M')}}</p>
                            <p class="text-dark">{{$event->venue}}</p>
                        </div>
                        <a href="{{url('event', ['event_slug' => $event->event_slug])}}" class="text-decoration-none btn-custom">Learn More <i
                                class="fa fa-angle-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$previousEvents->links()}}
    </div>
</section>  
@endsection