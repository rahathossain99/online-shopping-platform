@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Coupon</a></li>
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
                        <h1>Create Coupon</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="" method="post" id="couponsForm" name="couponsForm">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Code</label>
                                        <input type="text" name="code" id="code" class="form-control" placeholder="Coupon Code">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea type="text" name="description" id="description" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="max_uses">Max Uses</label>
                                        <input type="text" name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="max_uses_user">Max Uses User</label>
                                        <input type="text" name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max Uses User">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="type">Discount Type</label>
                                        <select name="type"  id="type" class="form-control">
                                            <option value="">Select Discount Type</option>
                                            <option value="percent">Percent</option>
                                            <option value="fixed">Fixed</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="discount_amount">Discount Amount</label>
                                        <input type="number" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="min_amount">Min Amount</label>
                                        <input type="number" name="min_amount" id="min_amount" class="form-control" placeholder="Min Amount">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="starts_at">Starts At</label>
                                        <input type="datetime-local" name="starts_at" id="starts_at" class="form-control" placeholder="Starts At">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="expires_at">Expires At</label>
                                        <input type="datetime-local" name="expires_at" id="expires_at" class="form-control" placeholder="Expires At">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select name="status"  id="status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Block</option>
                                        </select>
                                        <p></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
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
        $('#couponsForm').submit(function (event) {
            event.preventDefault();
            var element=$(this);
            $.ajax({
                url:'{{ route("coupons.store") }}',
                type:'post',
                data:element.serializeArray(),
                dataType:'json',
                success:function (response) {
                    if(response['status']==true){
                        window.location.href='{{ route('coupons.index') }}';
                    }else{
                        var errors=response['error'];
                        if(errors['type']){
                            $('#type').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['type']);
                        }else{
                            $('#type').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");
                        }
                        if(errors['status']){
                            $('#status').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['status']);
                        }else{
                            $('#status').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");
                        }
                        if(errors['discount_amount']){
                            $('#discount_amount').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['discount_amount']);
                        }else{
                            $('#discount_amount').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");
                        }
                    }

                },error:function (jqXHR,exception) {
                    console.log("Something went wrong");
                }
            });
        });
    </script>
@endsection

