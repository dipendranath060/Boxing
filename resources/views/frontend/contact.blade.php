@extends('layouts.front-master')
@section('title', 'NPBC | About')
@section('image', asset('assets/images/logo.jpg'))
@section('content')
<!-- Breadcrumb Start -->

<section class="breadcrumbs">
    <div class="position-relative z-2 text-center">
        <h2 class="text-white breadcrumb-title">Contact</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homes')}}"
                        class="text-white fw-semibold text-decoration-none"><i class="fa fa-home me-1"></i>Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->


<section class="contact">
    <div class="container">
        <div class="section-heading mb-5 text-center">
            <h6 class="section-subtitle mb-2"><span>CONTACT</span></h6>
            <h2 class="section-title mb-4">Get in touch with us</h2>
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
    
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="contact-form rounded-4 p-5">
                <h5 class="mb-4 text-white">Leave us a message</h5>
                <form action="{{route('sendMail')}}" method="POST">
                    @csrf
                    <input type="text" name="name" class="w-100 contact-input mb-3" placeholder="Enter Your Name" required>
                    <input type="email" name="email" class="w-100 contact-input mb-3" placeholder="Enter Your Email" required>
                    <input type="number" name="phone" class="w-100 contact-input mb-3" placeholder="Enter Your Number">
                    <textarea name="message" class="w-100 contact-input mb-4" rows="5"
                        placeholder="Write Message"></textarea>
                    <div class="text-center">
                        <button class="btn btn-main">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection