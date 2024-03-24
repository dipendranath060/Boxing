@extends('layouts.master')
@section('title', 'List | Gallery')
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
          <li class="breadcrumb-item active" aria-current="page">Gallery</li>
          <li class="breadcrumb-item active" aria-current="page">
            Gallery List
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Gallery List Table -->
  <section class="blog-list">
    <div class="container">
      <h2 class="mb-5 section-title border-bottom pb-3 text-center">
        Gallery List
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
            <a href="{{route('add-gallery')}}" class="btn btn-success"
              >+ Add New Album</a
            >
          </div>
            @if ($gallery->isEmpty())
                    <h4 class="text-black text-center">Albums Not Found....</h4>
              @else
            <table class="w-100 text-center bg-white" id="table-list">
                    <tr class="border-top border-bottom">
                    <th class="py-3 px-1">S.N</th>
                    <th class="py-3 xpx-1">Title</th>
                    <th class="py-3 px-1">Thumbnail</th>
                    <th class="py-3 px-1">Action</th>
                    </tr>
                    @foreach ($gallery as $item)
                    <tr>
                        <td class="py-3 px-1">{{$loop->iteration}}</td>
                        <td class="py-3 px-1">{{Str::limit($item->title, 30)}}</td>
                        <td>
                            <img src="{{asset('uploads/gallery/'.$item->image)}}" width="80px" alt="img">
                        </td>
                        {{-- <td>
                          @foreach(json_decode($item->images) as $image)
                          <img src="{{ asset('uploads/gallery/' . $image) }}" width="80px"  alt="Image">
                          @endforeach
                        </td> --}}
                        <td class="py-3 px-1">
                        <a type="button" href="{{url('admin/edit-gallery/'.$item->id)}}" class="btn btn-success mb-1">
                            Edit
                        </a>
                          <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $item->id }}">
                            Delete
                        </button>
                        </td>
                    </tr>
               {{-- modal starts --}}
               <div class="modal fade" id="deleteModal_{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Album</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Album?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteGalleryForm" action="{{url('admin/delete-gallery/'.$item->id)}}" method="POST">
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
        {{ $gallery->links() }}
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
          const itemId = $(this).data('item-id');
          $('#deleteGalleryForm_' + itemId).attr('action', '{{ url("admin/delete-gallery") }}/' + itemId);
      });

      $('#deleteGalleryForm').on('submit', function(e) {
          e.preventDefault();
      });
  });
</script>
@endsection