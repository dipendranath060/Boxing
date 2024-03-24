@extends('layouts.front-master')
@section('title', 'NPBC | Registration')
@section('image', asset('assets/images/logo.jpg'))
@section('content')
<!-- Breadcrumb Start -->

<section class="breadcrumbs">
    <div class="position-relative z-2 text-center">
        <h2 class="text-white breadcrumb-title">Registration</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('homes')}}" class="text-white fw-semibold text-decoration-none">
                        <i class="fa fa-home me-1"></i>
                        Home
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Registration</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Breadcrumb End -->


<section class="registration-form">
    <div class="container">
        <div class="section-heading">
            <h6 class="section-subtitle mb-2"><span>REGISTRATION</span></h6>
            <h2 class="section-title mb-4">Registration form</h2>
        </div>
        <div class="section-body p-3">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <table class="text-white form-table overflow-auto w-100">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Form</th>
                        </tr>
                        @foreach ($registrations as $document)
                        <tr>
                            <td>{{ Str::limit($document->title,50) }}</td>
                            <td>{{ Str::limit($document->description,100) }}</td>
                            <td class="d-flex align-items-center gap-3"><img src="{{asset('assets/images/pdf_icon.png')}}" 
                                alt="" height="50" width="50"><a href="{{ route('fdownload', ['id' => $document->id]) }}" target="_blank" class="text-decoration-none"><i class="fa fa-download"></i></a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection