@extends('layouts.front-master')
@section('title', $news->meta_title)
@section('meta_description', $news->meta_description)
@section('image', asset('uploads/news/'.$news->image))
@section('content')
<!-- Breadcrumb Start -->

<section class="breadcrumbs">
    <div class="position-relative z-2 text-center">
        <h2 class="text-white breadcrumb-title">News</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homes')}}" class="text-white fw-semibold text-decoration-none">
                        <i class="fa fa-home me-1"></i>Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page"><a href="blog.html"
                        class="text-decoartion-none text-white"></a>News</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<!-- news container -->

<section class="news-single">
    <div class="container">
        <div class="row bg-dark rounded-3 news-single-container">
            <div class="col-lg-8">
                <div class="rounded-3 p-3">
                    <div class="news-single-img">
                        <img src="{{asset('uploads/news/'.$news->image)}}" alt="" class="w-100 rounded-3 mb-4">
                        <span class="news-single-date">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->updated_at)->format('d M')}}</span>
                    </div>
                    <div class="news-single-details px-3 mb-5">
                        @foreach($news->categories as $category)
                        <span class="single-news-cat text-white me-2">
                            {{ $category->name }}
                        </span>
                        @endforeach
                        <h4 class="my-4 text-white">{{$news->title}}</h4>
                        <p>
                            {!!$news->description!!}
                        </p>
                    </div>
                    <div class="share-news p-3 text-end d-flex align-items-center justify-content-end">
                        <span class="me-3">Share :</span>
                        <ul class="social-share list-unstyled m-0">
                            <li><a href="https://www.facebook.com/sharer.php?u={{url('show-news/'.$news->news_slug)}}"
                                    target="_blank"><i class="fa fa-facebook-official"></i></a></li>
                            <li><a href="https://twitter.com/intent/tweet?url={{url('show-news/'.$news->news_slug)}}&text={!!$news->title!!}"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-3">
                <div class="news-sidebar">
                    <div class="recent-posts text-white">
                        <h4>Recent Posts</h4>
                        @foreach ($upcomingNews as $news)
                        <div class="media border-bottom py-3">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0">
                                    <img loading="lazy" width="64" height="64" src="{{asset('uploads/news/' .$news->image)}}" alt="img" />
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6><a href="{{url('news', ['news_slug' => $news->news_slug])}}" class="text-white fs-6 text-decoration-none">{{$news->title}}</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection