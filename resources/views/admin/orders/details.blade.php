@extends('admin.layouts.app')

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Order: #{{ $orderInfo->id }}</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                @include("admin.message")
                <div class="row">
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header pt-3">
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <h1 class="h5 mb-3">Shipping Address</h1>
                                        <address>
                                            <strong>{{ $orderInfo->first_name.' '.$orderInfo->last_name }}</strong><br>
                                            {{ $orderInfo->address }}<br>
                                            {{ $orderInfo->city }}, C{{ $orderInfo->zip }}<br>
                                            Phone: (804) {{ $orderInfo->mobile }} <br>
                                            Email: {{ $orderInfo->email }}
                                        </address>
                                    </div>



                                    <div class="col-sm-4 invoice-col">
                                        <b>Invoice #007612</b><br>
                                        <br>
                                        <b>Order ID:</b>{{ $orderInfo->id }}<br>
                                        <b>Total:</b> {{ $orderInfo->grand_total }}<br>
                                        <b>Status:</b> @if($orderInfo->status=='pending')
                                                            <span class="badge bg-danger">Pending</span>
                                                        @elseif($orderInfo->status=='shipped')
                                                            <span class="badge bg-info">Shipped</span>
                                                        @elseif($orderInfo->status=='cancelled')
                                                            <span class="badge bg-warning">Cancelled</span>
                                                        @else
                                                            <span class="badge bg-success">Delivered</span>
                                                        @endif
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-3">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th width="100">Price</th>
                                        <th width="100">Qty</th>
                                        <th width="100">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($orderInfo->orderedProduct->isNotEmpty())
                                        @foreach($orderInfo->orderedProduct as $orderedProduct)
                                            <tr>
                                                <td>{{ $orderedProduct->name }}</td>
                                                <td>{{ $orderedProduct->price }} Tk</td>
                                                <td>{{ $orderedProduct->qty }}</td>
                                                <td>{{ $orderedProduct->total }} Tk</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <th colspan="3" class="text-right">Subtotal:</th>
                                        <td>{{ $orderInfo->subtotal }} Tk</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Discount{{ (!empty($orderInfo->coupon_code)) ? '('.$orderInfo->coupon_code.')' : ''}}</th>
                                        <td>{{ $orderInfo->discount }} Tk</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Shipping:</th>
                                        <td>{{ $orderInfo->shipping }} Tk</td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-right">Grand Total:</th>
                                        <td>{{ $orderInfo->grand_total }} Tk</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <form action="" method="post" id="changeOrderStatusForm">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Order Status</h2>
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option {{ ($orderInfo->status=='pending') ? 'selected': '' }} value="pending">Pending</option>
                                            <option {{ ($orderInfo->status=='shipped') ? 'selected': '' }} value="shipped">Shipped</option>
                                            <option {{ ($orderInfo->status=='delivered') ? 'selected': '' }} value="delivered">Delivered</option>
                                            <option {{ ($orderInfo->status=='cancelled') ? 'selected': '' }} value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="shipped_date">Shipped Date</label>
                                        <input type="datetime-local" name="shipped_date" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Send Inovice Email</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="">Customer</option>
                                        <option value="">Admin</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('customJs')
    <script>
        $('#changeOrderStatusForm').submit(function (event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route("orders.changeOrderStatus",$orderInfo->id) }}',
                type: 'post',
                data: element.serializeArray(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.href="{{ route('orders.detail',$orderInfo->id) }}"
                }
            });
        });
    </script>
@endsection

