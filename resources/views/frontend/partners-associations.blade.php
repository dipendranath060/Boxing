@extends('layouts.front-master')
@section('title', 'NPBC | Partners And Associations')
@section('image', asset('assets/images/logo.jpg'))
@section('content')
<!-- Breadcrumb Start -->

<section class="breadcrumbs">
    <div class="position-relative z-2 text-center">
        <h2 class="text-white breadcrumb-title">About Us</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('homes')}}" class="text-white fw-semibold text-decoration-none">
                        <i class="fa fa-home me-1"></i>
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Partners and Associations</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<section class="partners-associations">
    <div class="container">
        <div class="section-heading text-center mb-5">
            <h6 class="section-subtitle mb-2"><span>PARTNERS</span></h6>
            <h2 class="section-title mb-4">Meet Our Partners & Associations</h2>
        </div>
        <div class="section-body">
            <div class="row justify-content-center">
                @foreach ($partnersAssociations as $association)
                <div class="col-lg-2 mb-4 association-logo">
                    <img src="{{asset('uploads/member-association/'.$association->image)}}" alt="" class="w-100" height="130">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection