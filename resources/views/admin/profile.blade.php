@extends('layouts.master')
@section('title', 'Admin | Profile')
@section('content')
    
 <!-- Breadcrumb -->
 <div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="bg-white p-2 breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>
</div>

<div class="user-container py-3">
    <div class="container">
        <div class="row mb-3 justify-content-center">
            <div class="col-lg-7">
                <div class="add-form bg-white p-4 rounded">
                    <h2 class="mb-5 section-title border-bottom pb-1"><img src="{{asset('assets/icons/user.png')}}" alt="" width="44" height="44" class="me-2">Your Profile</h2>
                    <!-- <div class="text-end"> -->
                        
                    <!-- </div> -->
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <p class="text-black">Username: </p>
                            <p class="text-black">Email: </p>
                        </div>
                        <div class="col-lg-9">
                            <p class="text-black">{{ auth()->user()->name }}</p>
                            <p class="text-black">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection