@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('shippings.index') }}">Shipping</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Shipping Management</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('shippings.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="" method="post" id="shippingForm" name="shippingForm">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        {{--                                        <label for="country">Country</label>--}}
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a country</option>
                                            @if($countries->isNotEmpty())
                                                @foreach($countries as $country)
                                                    <option {{($shippingCharge->country_id==$country->id) ? "selected": ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                                <option {{($shippingCharge->country_id=='rest_of_world') ? "selected": ''}} value="rest_of_world">Rest of The World</option>
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="amount" id="amount" value="{{ $shippingCharge->amount }}" placeholder="Amount">
                                    <p></p>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--                    <div class="pb-5 pt-3">--}}
                    {{--                        --}}
                    {{--                        <a href="" class="btn btn-outline-dark ml-3">Cancel</a>--}}
                    {{--                    </div>--}}
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('customJs')
    <script>
        $('#shippingForm').submit(function (event) {
            event.preventDefault();
            var element=$(this);
            $.ajax({
                url:'{{ route('shippings.update',$shippingCharge->id) }}',
                type:'post',
                data:element.serializeArray(),
                dataType:'json',
                success:function (response) {
                    if(response['status']==true){
                        window.location.href='{{ route('shippings.index') }}';
                    }else{
                        var errors=response['errors'];
                        if(errors['country']){
                            $('#country').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['country']);
                        }else{
                            $('#country').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");
                        }
                        if(errors['amount']){
                            $('#amount').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['amount']);
                        }else{
                            $('#amount').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");
                        }
                    }

                },error:function (jqXHR,exception) {
                    console.log("Something went wrong");
                }
            })
        })

    </script>
@endsection

