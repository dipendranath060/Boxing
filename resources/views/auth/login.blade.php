@extends('layouts.app')

@section('content')
    
        <div class="login overflow-hidden">
    <div class="row align-items-center">
        <div class="col-lg-6 col-md-5 col-sm-12 col-12 login-logo mb-3">
        
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center login-content col-md-7 col-sm-5 col-6">
                        <div class="content-left">
                            <img src="{{asset('assets/icons/logomain.png')}}" alt="" class="w-100">
                            <h3 class="fw-bolder">Changing The ERA Of Digitalization</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div
                        class="col-lg-10 col-md-10 col-sm-10 col-10 position-relative d-none d-md-block d-lg-block d-xl-block d-xxl-block">
                        <img src="{{asset('assets/icons/people1.png')}}" alt="" class="w-100 position-absolute bottom-0 start-0 z-1" height="150px">
                    </div>
                </div>
            </div>
        <div class="col-lg-6 col-md-7 col-sm-12 col-12">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-8 col-sm-9 col-9">
                    <div class="login-form bg-white p-4 rounded mt-5">
                        <h5 class="text-center mb-3">{{ __('Log in') }}</h5>
                        <h2 class="mb-4 text-center">Hi! Members</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="d-flex align-items-end mb-4 gap-2">
                                <i class="fa fa-user" style="color: #000000;"></i>
                                <input type="email" placeholder="{{ __('Enter Your Username') }}" class="w-100 login-input @error('email') is-invalid @enderror" name="email" value="{{ old('username') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex align-items-end mb-5 gap-2 position-relative">
                                <i class="fa fa-lock" style="color: #000000;"></i>
                                <input type="password" placeholder="{{ __('Enter Your Password') }}" class="w-100 login-input pass @error('password') is-invalid @enderror" name="password" required autocomplete="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <i class="fa fa-eye position-absolute end-0 mb-1 pass-icon" style="color: #000000;" ></i>
                            </div>
                            <div class="text-center mb-4">
                                <button class="rounded login-submit px-5 btn" type="submit">
                                    {{ __('Log In') }}
                                    <i class="fa fa-arrow-right" style="color: #ffffff;"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
@endsection
