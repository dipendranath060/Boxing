@extends('layouts.master')
@section('title', 'List | Banner')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Banner</li>
                <li class="breadcrumb-item active" aria-current="page">Banner List</li>
            </ol>
        </nav>
    </div>
</div>

<!-- banner List Table -->
<section class="testimonial-list">
    <div class="container">
        <h2 class="mb-5 section-title border-bottom pb-3 text-center">Banner List</h2>
        <div class="row justify-content-center">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if (session('status'))
                <div class="alert alert-danger">{{session('status')}}</div>
            @endif
            <div class="col-lg-10 overflow-auto">
                <div class="text-end mb-3">
                    <a href="{{route('add-banner')}}" class="btn btn-success">+ Add New Banner</a>
                </div>
                @if ($banners->isEmpty())
                    <h4 class="text-black text-center">No Banners Found....</h4>
                @else
                <table class="w-100 bg-white text-center" id="table-list">
                    <tr class="border-top border-bottom">
                        <th class="py-3 px-1">S.N</th>
                        <th class="py-3 px-1">Title</th>
                        <th class="py-3 px-1">Image</th>
                        <th class="py-3 px-1">Action</th>
                    </tr>
                    @foreach ($banners as $banner)
                    <tr>
                        <td class="py-3 px-1">{{$loop->iteration}}</td>
                        <td class="py-3 px-1">{{Str::limit($banner->title,20)}}</td>
                        <td>
                            <img src="{{asset('uploads/banners/'.$banner->image)}}" width="80px" alt="img">
                        </td>
                            <td class="py-3 px-1">
                                <a href="{{ url('admin/edit-banner/'.$banner->id) }}" class="btn btn-success mb-1">Edit</a>
                                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $banner->id }}">
                                    Delete
                                </button>
                            </td>
                        </td>
                    </tr>
                    {{-- modal starts --}}
                    <div class="modal fade" id="deleteModal_{{ $banner->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Banner</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this banner?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteBannerForm" action="{{ url('admin/delete-banner/'.$banner->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </table>
                {{ $banners->links() }}
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
            const bannerId = $(this).data('banner-id');
            $('#deleteBannerForm_' + bannerId).attr('action', '{{ url("admin/delete-banner") }}/' + bannerId);
        });

        $('#deleteBannerForm').on('submit', function(e) {
            e.preventDefault();
        });
    });
</script>
@endsection