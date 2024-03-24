@extends('layouts.front-master')
@section('title', 'NPBC')
@section('image', asset('assets/images/logo.jpg'))
@section('content')

    <!-- Home Slider Start -->

    <section class="owl-carousel owl-theme home-slider">
        @foreach ($banners as $banner) 
        @if ($loop->index < 2)
        <div class="item">
            <div class="container">
                <div class="slider-text">
                    <h1 class="text-capitalize mb-4">{{ Str::limit($banner->title, 30)}}</h1>
                </div>
                <div class="home-slider-img w-100" style="background-image: url({{asset('uploads/banners/' .$banner->image)}});"></div>
            </div>
        </div>
        @endif
        @endforeach
    </section>

    <!-- Home Slider End -->



    <!-- About Section Start -->

    <section class="about mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 p-5 about-img">
                </div>
                <div class="col-lg-7 pb-5">
                    <div class="section-heading ps-lg-5">
                        <h6 class="section-subtitle mb-2"><span>ABOUT</span></h6>
                        <h2 class="section-title mb-4">Empower Punches, Forge Champions.</h2>
                    </div>

                    <div class="section-body ms-3">
                        <p>
                            The Boxing Association Nepal stands as the guiding force behind Nepal's boxing landscape, dedicated to nurturing the sport's growth and excellence. Committed to fostering talent and promoting the sport's values of discipline and determination, it facilitates training, competitions, and infrastructure development across the country. 
                        </p>
                        <p>
                            With a vision to empower athletes, the association strives for inclusivity, offering opportunities to aspiring boxers from diverse backgrounds. Through strategic partnerships, coaching advancements, and organizing national and international events, it aims to elevate Nepal's presence in the global boxing arena. The association's unwavering dedication makes it a cornerstone in honing athletes' skills and fostering a vibrant boxing community in Nepal.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section End -->



    <!-- Milestone Section Start -->

    <section class="milestones">
        <div class="container">
            <div class="row">
                @foreach ($milestones as $milestone) 
                @if ($loop->index < 4)
                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                    <div class="milestone text-center position-relative z-2">
                        <p class="milestone-data counter-stat text-white fs-2 fw-semibold mb-1">{{$milestone->achievements}}</p>
                        <span class="milestone-text text-white">{{$milestone->title}}</span>
                    </div>
                </div>
                @endif 
                @endforeach
            </div>
        </div>
    </section>

    <!-- Milestone Section End -->



    <!-- Events Section Start -->

    <section class="events">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6 class="section-subtitle mb-2"><span>EVENTS</span></h6>
                        <h2 class="section-title mb-4">Upcoming events for positive change</h2>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                @foreach ($upcomingEvents as $event)
                @if ($loop->index < 4)
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
                                        {{Str::limit($event->description,85)}}
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
                @endif
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{route('event')}}" class="btn btn-main">View All Events</a>
            </div>
        </div>
    </section>

    <!-- Events Section End -->


    <!-- News Section Start -->

    <section class="news">
        <div class="container">
            <div class="section-heading text-center mb-4">
                <h6 class="section-subtitle mb-3"><span>NEWS</span></h6>
                <h2 class="section-title mb-4">Our Recent News</h2>
            </div>
            <div class="row justify-content-center">
                @foreach ($news as $item)
                 @if ($loop->index < 3)
                 <div class="col-lg-4 col-md-6 mb-4">
                     <div class="news-card">
                         <div class="news-image rounded-3">
                             <a href="{{url('news', ['news_slug'=> $item->news_slug])}}">
                                 <img src="{{asset('uploads/news/' .$item->image)}}" alt="{{$item->image_alt}}" class="w-100 rounded-3">
                                </a>
                            </div>
                            <div class="news-details text-black bg-white p-3 rounded-bottom-3">
                                <div class="d-flex gap-2">
                                    <div class="news-date"><i class="fa fa-calendar me-1"></i>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d M')}}</div>
                                    @foreach($item->categories as $category)
                                    @if ($loop->index < 2)
                                    <div class="news-category"><i class="fa fa-tags me-1"></i> 
                                        {{ $category->name }}
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                                <h5 class="my-2 news-title fw-bold"><a href="{{url('news', ['news_slug' => $item->news_slug])}}"
                                    class="text-decoration-none fs-5">{{Str::limit($item->title, 35)}}</a>
                                </h5>
                                <p class="text-black">
                                    @php
                                    $plainTextContent = strip_tags($item->description);
                                    $limitedText = substr($plainTextContent, 0, 85);
                                    @endphp
                                    {{$limitedText}} ....
                                </p>
                                <a href="{{url('news', ['news_slug'=> $item->news_slug])}}" class="text-decoration-none btn-readmore">Read More <i class="fa fa-angle-double-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>            
                @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- News Section End -->


    <section class="associations">
        <div class="container">
            <ul class="association-slider d-flex list-unstyled align-items-center m-0 owl-carousel owl-theme">
                @foreach ($associations as $association)
                <li><img src="{{asset('uploads/member-association/' .$association->image)}}" alt="" height="120" width="120"></li>
                @endforeach
            </ul>
        </div>
    </section>


    <!-- Popup start -->
    @if ($notifications->isNotEmpty())
    <div id="pop-up" class="row justify-content-center align-items-center m-0 d-none">
        @foreach ($notifications as $notification)
        @if ($loop->index < 1)
        <div class="col-md-6 col-10">
            <div class="popup-container rounded-3 p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="mb-0">{{$notification->title}}</h4>
                    <span id="popup-close" class="fs-1">
                        &times;
                    </span>
                </div>
                <a href="{{$notification->link}}">
                    <img src="{{asset('uploads/notifications/' .$notification->image)}}" alt="" class="w-100">
                </a>
            </div>
        </div>
        @endif 
        @endforeach
    </div>
    @endif

    <!-- Popup end -->
    
@endsection

@section('scripts')
<script>
    $('.home-slider').owlCarousel({
        loop: true,
        items: 1,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: false,
        autoplay: true
    })
    $('.association-slider').owlCarousel({
        loop: true,
        items: 5,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: false,
        autoplay: true,
        margin:15,
        responsive: {
            0: {
                items: 2
            },
            767: {
                items: 4,
            },
            992: {
                items: 6,
            }
        }
    })
</script>
@endsection