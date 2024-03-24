@extends('layouts.front-master')
@section('title', 'NPBC | News')
@section('image', asset('assets/images/logo.jpg'))
@section('content')
<!-- Breadcrumb Start -->

<section class="breadcrumbs">
    <div class="position-relative z-2 text-center">
        <h2 class="text-white breadcrumb-title">News</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homes')}}"
                        class="text-white fw-semibold text-decoration-none">
                        <i class="fa fa-home me-1"></i>Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">News</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<!-- news Section Start -->

<section class="news">
    <div class="container">
        <div class="section-heading text-center mb-4">
            <h6 class="section-subtitle mb-3"><span>NEWS</span></h6>
            <h2 class="section-title mb-4">Our Recent News</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($news as $item) 
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="news-card">
                    <div class="news-image rounded-3">
                        <a href="{{url('news', ['news_slug' =>$item->news_slug])}}">
                            <img src="{{asset('uploads/news/' .$item->image)}}" alt="" class="w-100 rounded-3">
                        </a>
                    </div>
                    <div class="news-details text-black bg-white p-3 rounded-bottom-3">
                        <div class="d-flex gap-2">
                            <div class="news-date"><i class="fa fa-calendar me-1"></i>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d M')}}</div>
                            @foreach($item->categories as $category)
                            @if($loop->index < 2)
                            <div class="news-category"><i class="fa fa-tag me-1"></i> 
                                {{ $category->name }}
                            </div>
                            @endif
                        @endforeach
                        </div>
                        <h5 class="my-2 news-title fw-bold"><a href="{{url('news', ['news_slug' => $item->news_slug])}}"
                            class="text-decoration-none fs-5">{{$item->title}}</a>
                        </h5>
                        <p class="text-black">
                            @php
                            $plainTextContent = strip_tags($item->description);
                            $limitedText = substr($plainTextContent, 0, 50);
                            @endphp
                            {{$limitedText}} ....
                        </p>
                        <a href="{{url('news', ['news_slug' =>$item->news_slug])}}" class="text-decoration-none btn-readmore">Read More <i class="fa fa-angle-double-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{$news->links()}}
    </div>
</section>

<!-- news Section End -->
@endsection