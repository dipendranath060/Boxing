@extends('layouts.master')
@section('title', 'Show | Rules and Regulations')
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
            <a href="{{route('rules')}}">Rules and Regulations</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Show-Rules and Regulations
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
                    <div class="blog-single-details px-3">
                        <h4 class="my-4">{!!$rule->title!!}</h4>
                        <p>{!!$rule->body_content!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection