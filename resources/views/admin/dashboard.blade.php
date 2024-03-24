@extends('layouts.master')
@section('title', 'Admin | Dashboard')
@section('content')
    
<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
  <div class="container">
    <nav
      aria-label="breadcrumb"
      class="bg-white p-2 breadcrumb-main rounded"
    >
      <ol class="breadcrumb m-0 justify-content-start">
        <li class="breadcrumb-item active" aria-current="page">
          Dashboard
        </li>
      </ol>
    </nav>
  </div>
</div>

<section class="dashboard-details mb-3">
  <div class="container">
    <h3 class="mb-4" id="user">Welcome, {{auth()->user()->name}}</h3>
    <div class="row">
        <!-- Weather -->
        <div class="col-lg-8 mb-3">
            <div class="weather">
                <div id="weather-data" class="text-end">
                    <div id="weather-details">
                        <p class="mb-0 fs-2 fw-lighter"><span id="time"
                                class="fs-2 fw-semibold me-2"></span> | <span id="temp"
                                class="fs-2 fw-semibold ms-2"></span>
                            <img src="" alt="Loading" id="weatherimg" height="60" width="60">
                        </p>
                        <p id="weather-description" class="text-capitalize mb-1"></p>
                        <p id="weather-location" class="fs-5 fw-medium"></p>
                        <p id="weather-error"></p>
                    </div>
                </div>
            </div>
        </div>
      
      <!-- Counts -->
      <div class="col-lg-4 mb-3">
        <div class="blog-details">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="num box py-3 px-2">
                <div class="position-relative z-2">
                  <p class="text-white mb-1">Total of News</p>
                  <span class="text-white">{{$news}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="cmt box py-3 px-2">
                <div class="position-relative z-2">
                  <p class="text-white mb-1">Total Events</p>
                  <span class="text-white">{{$events}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="des box py-3 px-2">
                <div class="position-relative z-2">
                  <p class="text-white mb-1">Rules and Regulations</p>
                  <span class="text-white">{{$rules}}</span>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="proj box py-3 px-2">
                <div class="position-relative z-2">
                  <p class="text-white mb-1">Total Board Members</p>
                  <span class="text-white">{{$boardMembers}}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="main-body mb-4">
<!-- Upcomming events table -->
      <div class="col-lg-12">
        <div class="recent pb-4 bg-white subtitle">
          <h4 class="p-3 mb-0">Upcoming Events...</h4>
          <div class="px-3 overflow-auto">
            <table class="w-100 text-center bg-white" id="table-list">
              <tr class="border-top border-bottom">
                <th class="py-3 px-1">S.N</th>
                <th class="py-3 px-1">Title</th>
                <th class="py-3 px-1">Image</th>
                <th class="py-3 px-1">Date</th>
                <th class="py-3 px-1">Day</th>
                <th class="py-3 px-1">Time</th>              </tr>
                @foreach ($upcomingEvents as $event)  
                <tr>
                  <td class="py-3 px-1">{{$loop->iteration}}</td>
                <td class="py-3 px-1">{{$event->title}}</td>
                <td>
                  <img src="{{url('uploads/events/'.$event->image)}}" width="70px" alt="img">
                </td>
                <td class="py-3 px-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('Y-m-d') }}</td>
                <td class="py-3 px-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('l') }}</td>
                <td class="py-3 px-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('h:i A') }}</td>
              </tr>
                @endforeach
              </table>
          </div>
        </div>
    </div>
  </div>
</section>
<script src="{{asset('assets/js/weather.js')}}"></script>
@endsection