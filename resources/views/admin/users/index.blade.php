@extends('layouts.master')
@section('title', 'List | User')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb-area mb-3">
    <div class="container">
        <nav aria-label="breadcrumb" class="p-2 bg-white breadcrumb-main rounded">
            <ol class="breadcrumb m-0 justify-content-start">
                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
                <li class="breadcrumb-item active" aria-current="page">User List</li>
            </ol>
        </nav>
    </div>
</div>

<!-- user List Table -->
<section class="testimonial-list">
    <div class="container">
        <h2 class="mb-5 section-title border-bottom pb-3 text-center">User List</h2>
        <div class="row justify-content-center">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            @if (session('status'))
                <div class="alert alert-danger">{{session('status')}}</div>
            @endif
            <div class="col-lg-10 overflow-auto">
                <div class="text-end mb-3">
                    <a href="{{route('add-user')}}" class="btn btn-success">+ Add New User</a>
                </div>
                <table class="w-100 bg-white text-center" id="table-list">
                    <tr class="border-top border-bottom">
                        <th class="py-3 px-1">S.N</th>
                        <th class="py-3 px-1">Name</th>
                        <th class="py-3 px-1">Email</th>
                        <th class="py-3 px-1">Role</th>
                        <th class="py-3 px-1">Action</th>
                    </tr>
                    @foreach ($users as $user)
                    <tr>
                        <td class="py-3 px-1">{{$loop->iteration}}</td>
                        <td class="py-3 px-1">{{$user->name}}</td>
                        <td class="py-3 px-1">{{$user->email}}</td>
                        <td class="py-3 px-1">{{$user->role_as == '1' ? 'Super Admin':'Admin'}}</td>
                        <td class="py-3 px-1">
                            <a type="button" href="{{url('admin/edit-user/'.$user->id)}}" class="btn btn-success mb-1">Edit</a>
                            <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $user->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                    {{-- modal starts --}}
                    <div class="modal fade" id="deleteModal_{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this User?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteUserForm" action="{{ url('admin/delete-user/'.$user->id) }}" method="POST">
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
                {{$users->links()}}
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('button[data-bs-target^="#deleteModal"]').on('click', function() {
            const userId = $(this).data('user-id');
            $('#deleteUserForm_' + userId).attr('action', '{{ url("admin/delete-user") }}/' + userId);
        });
  
        $('#deleteUserForm').on('submit', function(e) {
            e.preventDefault();
        });
    });
  </script>
@endsection