@extends('layouts.front-master')
@section('title', 'NPBC | Field-Coordinators')
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
                <li class="breadcrumb-item active" aria-current="page">Field Coordinator</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<section class="field-coordinator">
    <div class="container">
        <div class="section-heading mb-5">
            <h6 class="section-subtitle mb-2"><span>MEMBERS</span></h6>
            <h2 class="section-title mb-4">Meet Our Field Co-ordinators</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($fieldCoordinators as $member)
            <div class="col-lg-3 col-md-6 mb-5">
                <div class="coordinator-member-card text-white">
                    <div class="coordinator-team-img">
                        <img src="{{asset('uploads/field-coordinators/' .$member->image)}}" alt="" class="w-100">
                    </div>
                    <div class="coordinator-team-details ps-2 py-1">
                        <h5 class="fw-medium text-uppercase m-0">{{$member->name}}</h5>
                        <h6 class="m-0 text-brand">{{$member->designation}}</h6>
                        <p class="m-0">{{$member->description}}</p>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</section>
@endsection