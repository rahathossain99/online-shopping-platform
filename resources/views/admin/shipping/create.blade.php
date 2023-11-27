@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('shippings.index') }}">Shipping</a></li>
        <li class="breadcrumb-item active">Create</li>
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
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                                    <option value="rest_of_world">Rest of The World</option>
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
                                    <p></p>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                url:'{{ route("shippings.store") }}',
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

