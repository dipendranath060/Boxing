@extends('layouts.master')
@section('title', 'List | Board-Member')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Board-Members</li>
                <li class="breadcrumb-item active" aria-current="page">Board-Member List</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Board List Table -->
<section class="testimonial-list">
    <div class="container">
        <h2 class="mb-5 section-title border-bottom pb-3 text-center">Board-Member List</h2>
        <div class="row justify-content-center">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if (session('status'))
                <div class="alert alert-danger">{{session('status')}}</div>
            @endif
            <div class="col-lg-10 overflow-auto">
                <div class="text-end mb-3">
                    <a href="{{route('add-board-member')}}" class="btn btn-success">+ Add New Board-Member</a>
                </div>
                @if ($boardMembers->isEmpty())
                    <h4 class="text-black text-center">Board Members Not Found....</h4>
                @else
                <table class="w-100 bg-white text-center" id="table-list">
                    <tr class="border-top border-bottom">
                        <th class="py-3 px-1">S.N</th>
                        <th class="py-3 px-1">Name</th>
                        <th class="py-3 px-1">Image</th>
                        <th class="py-3 px-1">Designation</th>
                        <th class="py-3 px-1">Action</th>
                    </tr>
                    @foreach ($boardMembers as $member)
                    <tr>
                        <td class="py-3 px-1">{{$loop->iteration}}</td>
                        <td class="py-3 px-1">{{$member->name}}</td>
                        <td>
                            <img src="{{asset('uploads/board-members/'.$member->image)}}" width="80px" alt="img">
                        </td>
                        <td class="py-3 px-1">{{$member->designation}}</td>
                        <td class="py-3 px-1">
                            <a type="button" href="{{url('admin/edit-board-member/'.$member->id)}}" class="btn btn-success mb-1">Edit</a>
                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $member->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                    {{-- modal starts --}}
                    <div class="modal fade" id="deleteModal_{{ $member->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Previous Member</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this Board Member?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteBoardForm" action="{{url('admin/delete-board-member/'.$member->id)}}" method="POST">
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
                {{ $boardMembers->links() }}
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
            const memberId = $(this).data('member-id');
            $('#deleteBoardForm_' + memberId).attr('action', '{{ url("admin/delete-board-member") }}/' + memberId);
        });
  
        $('#deleteBoardForm').on('submit', function(e) {
            e.preventDefault();
        });
    });
  </script>
@endsection