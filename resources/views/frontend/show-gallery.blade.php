@extends('layouts.front-master')
@section('title', $album->title)
@section('meta_description', $album->meta_description)
@section('image', asset('uploads/gallery/'.$album->image))
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
            <h2 class="section-title">{{$album->title}}</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($images as $image)  
            @if ($loop->index < 30)
            <div class="col-lg-4 col-md-6 mb-5">
                <div class="gallery-single-card mx-1 rounded-3">
                    <img src="{{asset('uploads/gallery/' .$image)}}" alt="" class="w-100 rounded-3 gallery-single-img">
                    <div class="gallery-hover">
                        <span class="view-img">+</span>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>

<div class="d-none" id="gallery-modal">
    <div id="close-out"></div>
    <img src="" alt="" id="gallery-modal-img">
    <div id="close">&times;</div>
    <div id="prev-img">
        <i class="fa fa-angle-left" style="color: white;"></i>
    </div>
    <div id="next-img">
        <i class="fa fa-angle-right" style="color: white;"></i>
    </div>
</div>
@endsection