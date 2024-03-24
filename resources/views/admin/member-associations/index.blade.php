@extends('layouts.master')
@section('title', 'List | Member Association')
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
          <li class="breadcrumb-item active" aria-current="page">Member Association</li>
          <li class="breadcrumb-item active" aria-current="page">
            Member Association List
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Member Association List Table -->
  <section class="blog-list">
    <div class="container">
      <h2 class="mb-5 section-title border-bottom pb-3 text-center">
        Member Association List
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
            <a href="{{route('add-association')}}" class="btn btn-success"
              >+ Add New Member Association</a
            >
          </div>
          @if($associations->isEmpty())
              <h4 class="text-black text-center">Member Associations Not Found...</h4>
          @else 
            <table class="w-100 text-center bg-white" id="table-list">
                    <tr class="border-top border-bottom">
                      <th class="py-3 px-1">S.N</th>
                      <th class="py-3 px-1">Title</th>
                      <th class="py-3 px-1">Image</th>
                      <th class="py-3 px-1">Description</th>
                      <th class="py-3 px-1">Action</th>
                    </tr>
    
                    @foreach ($associations as $association)
                    <tr>
                        <td class="py-3 px-1">{{$loop->iteration}}</td>
                        <td class="py-3 px-1">{{Str::limit($association->title,20)}}</td>
                        <td>
                            <img src="{{asset('uploads/member-association/'.$association->image)}}" width="80px" alt="img">
                        </td>
                        <td class="py-3 px-1">{{Str::limit($association->description,30)}}</td>
                        <td class="py-3 px-1">
                        <a type="button" href="{{url('admin/edit-member-association/'.$association->id)}}" class="btn btn-success mb-1">
                            Edit
                        </a>
                        <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $association->id }}">
                          Delete
                      </button>
                        </td>
                    </tr>
               {{-- modal starts --}}
               <div class="modal fade" id="deleteModal_{{ $association->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Member Association</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this Member Association?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deletememberForm" action="{{url('admin/delete-member-association/'.$association->id)}}" method="POST">
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
        {{ $associations->links() }}
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
          const associationId = $(this).data('assiociation-id');
          $('#deletememberForm_' + associationId).attr('action', '{{ url("admin/delete-association") }}/' + associationId);
      });

      $('#deletememberForm').on('submit', function(e) {
          e.preventDefault();
      });
  });
</script>
@endsection