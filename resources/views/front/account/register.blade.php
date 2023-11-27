@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Register</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            <div class="login-form">
                <form action="" method="post" id="formData">
                    <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Password" id="password" name="password">
                        <p></p>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
                    </div>
                    <div class="form-group small">
                        <a href="{{ route('user.forgotPassword') }}" class="forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-sm" value="Register">Register</button>
                </form>
                <div class="text-center small">Already have an account? <a href="{{ route('user.login') }}">Login Now</a></div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $("#formData").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url:'{{ route('user.processAuth') }}',
                type:'post',
                data:$(this).serializeArray(),
                dataType:'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function (response) {
                    if(response.status==true)
                    {
                        window.location.href="{{ route('user.login') }}";
                    }
                    else{
                        var errors=response['error'];
                        if(errors['name']){
                            $('#name').addClass('is-invalid').siblings('p').
                                addClass('invalid-feedback').html(errors['name']);
                        }
                        else{
                            $('#name').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html('Looks good!');
                        }
                        if(errors['email']){
                            $('#email').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['email']);
                        }
                        else{
                            $('#email').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html('Looks good!');
                        }
                        if(errors['password']){
                            $('#password').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['password']);
                        }
                        else{
                            $('#password').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html('Looks good!');
                        }
                    }
                }
            });
        })
    </script>
@endsection
