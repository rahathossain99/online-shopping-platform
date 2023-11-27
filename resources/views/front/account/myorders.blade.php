@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user.profile') }}">My Account</a></li>
                    <li class="breadcrumb-item">My Orders</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Orders #</th>
                                        <th>Date Purchased</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($myOrders->isNotEmpty())
                                        @foreach($myOrders as $myOrder)
                                        <tr>
                                            <td>
                                                <a href="{{ route('user.orderDetail',$myOrder->id) }}">{{ $myOrder->id }}</a>
                                            </td>
                                            <td>{{ $myOrder->created_at }}</td>
                                            <td>
                                                @if($myOrder->status=='pending')
                                                    <span class="badge bg-danger">Pending</span>
                                                @elseif($myOrder->status=='shipped')
                                                    <span class="badge bg-info">Shipped</span>
                                                @elseif($myOrder->status=='cancelled')
                                                    <span class="badge bg-warning">Cancelled</span>
                                                @else
                                                    <span class="badge bg-success">Delivered</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($myOrder->grand_total,2) }} Tk</td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <div class="card card-body">
                                            <tr>
                                                <td colspan="3">Orders Not Found</td>
                                            </tr>
                                        </div>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
