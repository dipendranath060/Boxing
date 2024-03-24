@extends('layouts.front-master')
@section('title', 'NPBC | Rules and Regulations')
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
                <li class="breadcrumb-item active" aria-current="page">Rules and Regulations</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->

<section class="rules-regulation">
    <div class="container">
        <div class="section-heading mb-4">
            <h6 class="section-subtitle mb-2"><span>RULES</span></h6>
            <h2 class="section-title mb-4">Rules and Regulations to follow:</h2>
        </div>
        @foreach ($rules as $rule)
        <div class="section-body p-3">
            <dl class="text-white">
                <dt>{{$loop->iteration}}. {{$rule->title}}</dt>
                <dd>
                    {!!$rule->body_content!!}
                  </dd>
            </dl>
        </div>
        @endforeach
    </div>
</section>
@endsection