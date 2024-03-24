@extends('layouts.front-master')
@section('title', 'NPBC | Medical-Teams')
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
                <li class="breadcrumb-item active" aria-current="page">Medical Team</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<section class="medical-members">
<div class="container">
    <div class="section-heading mb-5">
        <h6 class="section-subtitle mb-2"><span>MEMBERS</span></h6>
        <h2 class="section-title mb-4">Meet Our Medical Members</h2>
    </div>
    <div class="row justify-content-center">
        @foreach ($medicalTeams as $team)
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="medical-member-card text-black">
                <div class="medical-team-img">
                    <img src="{{asset('uploads/medical-members/' .$team->image)}}" alt="" class="w-100">
                    <div class="medical-team-details ps-2 py-1 w-100">
                        <h5 class="fw-medium text-uppercase m-0">{{$team->name}}</h5>
                        <h6 class="m-0 text-brand">{{$team->designation}}</h6>
                    </div>
                </div>
                <p class="m-0 medical-description bg-white p-1">{{$team->description}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>
@endsection