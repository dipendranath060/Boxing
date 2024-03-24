@extends('layouts.master')
@section('title', 'Show | News')
@section('content')


<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
      <nav
        aria-label="breadcrumb"
        class="p-2 bg-white breadcrumb-main rounded">
        <ol class="breadcrumb m-0 justify-content-start">
          <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">
            <a href="{{route('news')}}">News</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Show-News
          </li>
        </ol>
      </nav>
    </div>
  </div>

<section class="blog-single">
    <div class="container">
        <div class="row bg-white rounded-3 blog-single-container justify-content-center">
            <div class="col-lg-8">
                <div class="rounded-3 p-3">
                    <div class="blog-single-img">
                        <img src="{{asset('uploads/news/'.$news->image)}}" alt="" class="w-100 rounded-3 mb-4">
                        <span class="blog-single-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $news->created_at)->format('d M') }} </span>
                    </div>
                   
                    <div class="blog-single-details px-3 mb-5">
                        @foreach($news->categories as $category)
                            <span class="single-blog-cat">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    <div class="blog-single-details px-3">
                        <h4 class="my-4">{!!$news->title!!}</h4>
                        <p>{!!$news->description!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection