@extends('layouts.master')
@section('title', 'List | Rules and Regulations')
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
          <li class="breadcrumb-item active" aria-current="page">Rules and Regulations</li>
          <li class="breadcrumb-item active" aria-current="page">
            Rules and Regulations List
          </li>
        </ol>
      </nav>
    </div>
  </div>

  <!-- Rules and Regulations List Table -->
  <section class="blog-list">
    <div class="container">
      <h2 class="mb-5 section-title border-bottom pb-3 text-center">
        Rules and Regulations List
      </h2>
      <div class="row justify-content-center">
        @if(session('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        @if(session('status'))
        <div class="alert alert-danger">{{session('status')}}</div>
        @endif
        <div class="col-lg-12 overflow-auto">
          <div class="text-end mb-3">
            <a href="{{route('add-rule')}}" class="btn btn-success"
              >+ Add New Rules and Regulations</a
            >
          </div>
          @if($rules->isEmpty())
              <h4 class="text-black text-center">Rules and Regulations Not Found...</h4>
          @else 
              <table class="w-100 text-center bg-white" id="table-list">
                <tr class="border-top border-bottom">
                  <th class="py-3 px-1">S.N</th>
                  <th class="py-3 px-1">Title</th>
                  <th class="py-3 px-1">Description</th>
                  <th class="py-3 px-1">Action</th>
                </tr>
             
            @foreach ($rules as $rule)              
            <tr>
              <td class="py-3 px-1">{{$loop->iteration}}</td>
              <td class="py-3 px-1">{{Str::limit($rule->title,20)}}</td>
              <td class="py-3 px-1">
                @php
                  $plainTextContent = strip_tags($rule->body_content);
                  $limitedText = substr($plainTextContent, 0, 45);
                  @endphp
                  {{$limitedText}} ....
                </td>
                <td class="py-3 px-1">
                  <a type="button" href="{{url('admin/edit-rule/'.$rule->id)}}" class="btn btn-success mb-1">
                    Edit
                  </a>
                  <a type="button" href="{{url('admin/show-rule/'.$rule->id)}}" class="btn btn-info mb-1 text-white">
                    Show
                </a>
                <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $rule->id }}">
                  Delete
              </button>
                </td>
              </tr>
               {{-- modal starts --}}
               <div class="modal fade" id="deleteModal_{{$rule->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete rule</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this rule?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteRuleForm" action="{{url('admin/delete-rule/'.$rule->id)}}" method="POST">
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
            {{$rules->links()}}
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
          const ruleId = $(this).data('rule-id');
          $('#deleteRuleForm_' + ruleId).attr('action', '{{ url("admin/delete-rule") }}/' + ruleId);
      });

      $('#deleteRuleForm').on('submit', function(e) {
          e.preventDefault();
      });
  });
</script>
@endsection