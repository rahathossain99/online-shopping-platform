@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user.profile') }}">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            @include('admin.message')
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">

                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <form action="" method="post"  id="userFormData" name="userFormData">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" placeholder="Enter Your Name" class="form-control" value="{{ (!empty($userInfo->name)) ? $userInfo->name : ''}}">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" placeholder="Enter Your Email" class="form-control" value="{{ (!empty($userInfo->email)) ? $userInfo->email : ''}}">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" placeholder="Enter Your Phone" class="form-control" value="{{ (!empty($userInfo->phone)) ? $userInfo->phone : ''}}">
                                    </div>
                                    <div class="d-flex">
                                        <button type="submit" class="btn btn-dark btn-sm" >Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                        </div>
                        <form action="{{ route('user.updateAddress') }}" method="post"  id="addressFormData" name="addressFormData">
                            @csrf
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="first_name" value="{{ (!empty($customerAddress)) ? $customerAddress->first_name : '' }} " class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name">
                                            @error('first_name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" value="{{ (!empty($customerAddress)) ? $customerAddress->last_name : ''}}" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name">
                                            @error('last_name')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ (!empty($customerAddress)) ? $customerAddress->email : ''}}" placeholder="Email">
                                            @error('email')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="country">Country</label>
                                            <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                                                <option value="">Select a Country</option>
                                                @if($countries->isNotEmpty())
                                                    @foreach($countries as $country)
                                                        <option {{ ($customerAddress->country_id==$country->id) ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                    <option value="rest_of_world">Rest of The World</option>
                                                @endif
                                            </select>
                                            @error('country')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" cols="30" rows="4" placeholder="Address" class="form-control @error('address') is-invalid @enderror">{{ (!empty($customerAddress)) ? $customerAddress->address : ''}}</textarea>
                                            @error('address')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="apartment">Apartment</label>
                                            <input type="text" name="apartment" id="apartment" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->apartment : ''}}" placeholder="Apartment, suite, unit, etc.">
                                            @error('apartment')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ (!empty($customerAddress)) ? $customerAddress->city : ''}}" placeholder="City">
                                            @error('city')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="zip">Zip</label>
                                            <input type="text" name="zip" id="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ (!empty($customerAddress)) ? $customerAddress->zip : ''}}" placeholder="Zip">
                                            @error('zip')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ (!empty($customerAddress)) ? $customerAddress->mobile : ''}}" placeholder="Mobile No.">
                                            @error('mobile')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-dark btn-sm">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#userFormData').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('user.updateUser',$userInfo->id) }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status == true) {
                        window.location.href="{{ route('user.profile') }}";
                    } else {
                        var errors = response['errors'];
                        if (errors['name']) {
                            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
                        } else {
                            $('#name').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");
                        }
                        if (errors['email']) {
                            $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
                        } else {
                            $('#email').removeClass('is-invalid').addClass('is-valid').siblings('p').removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");
                        }
                    }
                }
            });
        });
    </script>
@endsection
