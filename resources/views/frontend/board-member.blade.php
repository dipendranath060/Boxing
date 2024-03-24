@extends('layouts.front-master')
@section('title', 'NPBC | Board-Members')
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
                <li class="breadcrumb-item active" aria-current="page">Board Members</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<section class="board-members">
    <div class="container">
        <div class="section-heading mb-5">
            <h6 class="section-subtitle mb-2"><span>MEMBERS</span></h6>
            <h2 class="section-title mb-4">Meet Our Board Members</h2>
        </div>
        <div class="row justify-content-center">
            @foreach ($boardMembers as $member)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="board-member-card px-3">
                    <div class="board-member-img mb-2">
                        <img src="{{asset('uploads/board-members/' .$member->image)}}" alt="" class="w-100">
                    </div>
                        <div class="board-member-description text-white pb-1">
                            <h4 class="text-uppercase">{{$member->name}}</h4>
                            <h6>{{$member->designation}}</h6>
                            <p>{{$member->description}}</p>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection