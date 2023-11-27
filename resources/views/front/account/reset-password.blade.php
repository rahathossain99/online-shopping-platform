@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Forgot Password</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            @if(Session::has('success'))
                <div class="col-md-12 align-items-center">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            <div class="login-form">
                <form action="{{ route('user.processResetPassword') }}" method="post" >
                    @csrf

                    <h4 class="modal-title">Enter New Password</h4>
                    <input type="hidden" value="{{ $token }}" name="token">
                    <div class="form-group">
                        <input type="text" class="form-control @error('new_password') is-invalid @enderror"  name="new_password" placeholder="New Password" >
                        @error('new_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('confirm_password') is-invalid @enderror"  name="confirm_password" placeholder="Confirm Password" >
                        @error('confirm_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark btn-sm">Submit</button>
                </form>
                <div class="text-center small"><a href="{{ route('user.login') }}">Login</a></div>
            </div>
        </div>
    </section>
@endsection

