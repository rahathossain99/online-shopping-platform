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
                        <h1>Orders</h1>
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
                <div class="card">
                    <form action="" method="get" >
                        <div class="card-header">
                            <div class="card-title">
                                <button type="button" onclick="window.location.href='{{ route('orders.index') }}'" class="btn btn-default btn-sm">Reset</button>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" value="{{ Request::get('keyword') }}" id="searchCategory" name="keyword" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Orders #</th>
                            <th>Customer</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date Purchased</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($orders->isNotEmpty())
                            @foreach($orders as $order)
                            <tr>
                                <td><a href="{{ route('orders.detail',$order->id) }}">{{ $order->id }}</a></td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->mobile }}</td>
                                <td>
                                    @if($order->status=='pending')
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif($order->status=='shipped')
                                        <span class="badge bg-info">Shipped</span>
                                    @elseif($order->status=='cancelled')
                                        <span class="badge bg-warning">Cancelled</span>
                                    @else
                                        <span class="badge bg-success">Delivered</span>
                                    @endif
                                </td>
                                <td>{{ $order->grand_total }} Tk</td>
                                <td>{{ $order->created_at->format('d,m,Y') }}</td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>


                <div class="card-footer clearfix">
                    {{ $orders->links() }}
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection




