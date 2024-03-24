@extends('layouts.master')
@section('title', 'List | Events')
@section('content')
    
<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
      <nav
        aria-label="breadcrumb"
        class="p-2 bg-white breadcrumb-main rounded"
      >
        <ol class="breadcrumb m-0 justify-content-start">
          <li class="breadcrumb-item">
            <a href="{{route('dashboard')}}">Dashboard</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Events</li>
          <li class="breadcrumb-item active" aria-current="page">
            Events List
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Events List Table -->
  <section class="blog-list">
    <div class="container">
      <h2 class="mb-5 section-title border-bottom pb-3 text-center">
        Events List
      </h2>
      <div class="row justify-content-center">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        @if(session('status'))
        <div class="alert alert-danger">{{session('status')}}</div>
        @endif
        <div class="col-lg-10 overflow-auto">
          <div class="text-end mb-3">
            <a href="{{route('add-event')}}" class="btn btn-success"
              >+ Add New Event</a
            >
          </div>
          @if($events->isEmpty())
              <h4 class="text-black text-center">Event Not Found...</h4>
          @else 
              <table class="w-100 text-center bg-white" id="table-list">
                  <tr class="border-top border-bottom">
                    <th class="py-3 px-1">S.N</th>
                    <th class="py-3 px-1">Title</th>
                    <th class="py-3 px-1">Image</th>
                    <th class="py-3 px-1">Venue</th>
                    <th class="py-3 px-1">Started Date</th>
                    <th class="py-3 px-1">Day</th>
                    <th class="py-3 px-1">Expiry Date</th>
                    <th class="py-3 px-1">Action</th>
                </tr>
                   @foreach ($events as $event)     
                <tr>
                    <td class="py-3 px-1">{{$loop->iteration}}</td>
                    <td class="py-3 px-1">{{Str::limit($event->title,15)}}</td>
                    <td>
                      <img src="{{asset('uploads/events/'.$event->image)}}" width="80px" alt="img">
                    </td>
                    <td class="py-3 px-1">{{Str::limit($event->venue,15)}}</td>
                    <td class="py-3 px-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->start_date)->format('Y-m-d') }}</td>
                    <td class="py-3 px-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->expiry_date)->format('l') }}</td>
                    <td class="py-3 px-1">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->expiry_date)->format('Y-m-d') }}</td>

                      <td class="py-3 px-1">
                        <a type="button" href="{{url('admin/edit-event/'.$event->id)}}" class="btn btn-success mb-1">
                          Edit
                        </a>
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $event->id }}">
                          Delete
                      </button>
                      </td>
                  </tr>
               {{-- modal starts --}}
               <div class="modal fade" id="deleteModal_{{$event->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Event</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Event?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteEventForm" action="{{url('admin/delete-event/'.$event->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
              @endforeach
            </table>
            {{$events->links()}}
            @endif
        </div>
      </div>
    </div>
  </section>
@endsection
@section('scripts')
<script>
  $(document).ready(function() {
      $('button[data-bs-target^="#deleteModal"]').on('click', function() {
          const eventId = $(this).data('event-id');
          $('#deleteEventForm_' + eventId).attr('action', '{{ url("admin/delete-event") }}/' + eventId);
      });

      $('#deleteEventForm').on('submit', function(e) {
          e.preventDefault();
      });
  });
</script>
@endsection