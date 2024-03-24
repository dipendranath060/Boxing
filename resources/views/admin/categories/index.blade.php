@extends('layouts.master')
@section('title', 'Category | list')
@section('content')
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
              <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active" aria-current="page">Categories</li>            </ol>
          </nav>                  
    </div>
</div>
<section class="categories-list">
    <div class="container">
        <h2 class="mb-5 section-title border-bottom pb-3 text-center">Categories List</h2>
        <div class="row justify-content-center">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if (session('status'))
                <div class="alert alert-danger">{{session('status')}}</div>
            @endif
            <div class="col-lg-10">
                <div class="text-end mb-2">
                    <a class="btn btn-success" href="{{ url('admin/add-category') }}">+ Add New Category</a>
                </div>
                <div class="overflow-auto">
                    @if($categories->isEmpty())
                        <h4 class="text-black text-center">Categories Not Found...</h4>
                    @else 
                    <table class="w-100 text-center bg-white" id="table-list">
                        <tr class="border-top border-bottom">
                            <th class="py-3 px-1">S.N</th>
                            <th class="py-3 px-1">Name</th>
                            <th class="py-3 px-1">Status</th>
                            <th class="py-3 px-1">Action</th>
                        </tr>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="py-3 px-1">{{$loop->iteration}}</td>
                                <td class="py-3 px-1">{{ $category->name }}</td>
                                <td class="py-3 px-1">{{$category->is_active ? 'Active':'Inactive'}}</td>
                                <td class="py-3 px-1">
                                    <a type="button" href="{{url('admin/edit-category/'.$category->id)}}" class="btn btn-success mb-1">Edit</a>
                                    <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $category->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            {{-- modal starts --}}
                            <div class="modal fade" id="deleteModal_{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this Category?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                            <form id="deleteCategoryForm" action="{{url('admin/delete-category/'.$category->id)}}" method="POST">
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
                    {{ $categories->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('button[data-bs-target^="#deleteModal"]').on('click', function() {
            const categoryId = $(this).data('category-id');
            $('#deleteCategoryForm_' + categoryId).attr('action', '{{ url("admin/delete-category") }}/' + categoryId);
        });
  
        $('#deleteCategoryForm').on('submit', function(e) {
            e.preventDefault();
        });
    });
  </script>
@endsection