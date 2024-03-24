@extends('layouts.front-master')
@section('title', 'NPBC | Gallery')
@section('image', asset('assets/images/logo.jpg'))
@section('content')
<!-- Breadcrumb Start -->

<section class="breadcrumbs">
    <div class="position-relative z-2 text-center">
        <h2 class="text-white breadcrumb-title">Gallery</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homes')}}"
                        class="text-white fw-semibold text-decoration-none"><i class="fa fa-home me-1"></i>Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Gallery</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<section class="gallery">
    <div class="container">
        <div class="section-heading mb-5">
            <h6 class="section-subtitle mb-2"><span>GALLERY</span></h6>
            <h2 class="section-title">Our Gallery</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($albums as $album)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-5 px-5 px-sm-0">
                <div class="gallery-card px-1">
                    <div class="p-1 bg-white">
                        <div class="gallery-thumbnail">
                            <a href="{{url('gallery', ['album_slug' => $album->album_slug])}}">
                                <img src="{{asset('uploads/gallery/' .$album->image)}}" alt="" class="w-100">
                            </a>
                        </div>
                    </div>
                    <h5 class="text-center mt-3"><a href="{{url('gallery', ['album_slug' =>$album->album_slug])}}" class="text-decoration-none">{{$album->title}}</a></h5>
                </div>
            </div>
            @endforeach
        </div>
        {{$albums->links()}}
    </div>
</section>
@endsection