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

                        <div class="card-body pb-0">
                            <!-- Info -->
                            <div class="card card-sm">
                                <div class="card-body bg-light mb-3">
                                    <div class="row">
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order No:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                {{ $orderInfo->id }}
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Shipped date:</h6>
                                            <!-- Text -->
                                            <p class="mb-lg-0 fs-sm fw-bold">
                                                <time datetime="2019-10-01">
                                                    {{ date('d M,Y',strtotime($orderInfo->shipped_date)) }}
                                                </time>
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Status:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                @if($orderInfo->status=='pending')
                                                    <span class="badge bg-danger">Pending</span>
                                                @elseif($orderInfo->status=='shipped')
                                                    <span class="badge bg-info">Shipped</span>
                                                @elseif($orderInfo->status=='cancelled')
                                                    <span class="badge bg-warning">Cancelled</span>
                                                @else
                                                    <span class="badge bg-success">Delivered</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-6 col-lg-3">
                                            <!-- Heading -->
                                            <h6 class="heading-xxxs text-muted">Order Amount:</h6>
                                            <!-- Text -->
                                            <p class="mb-0 fs-sm fw-bold">
                                                {{ $orderInfo->grand_total }} Tk
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer p-3">

                            <!-- Heading -->
                            <h6 class="mb-7 h5 mt-4">Order Items{{ '('.$orderCount.')' }}</h6>

                            <!-- Divider -->
                            <hr class="my-3">

                            <!-- List group -->
                            <ul>
                                @if($orderItems->isNotEmpty())
                                    @foreach($orderItems as $orderItem)
                                        <li class="list-group-item">
                                            <div class="row align-items-center">
                                                <div class="col-4 col-md-3 col-xl-2">
                                                    <!-- Image -->
                                                    <a href="{{ route('front.product',$orderItem->slug) }}"><img src="{{ asset('uploads/product/small/'.getProductImage($orderItem->product_id)->image) }}" alt="..." class="img-fluid"></a>
                                                </div>
                                                <div class="col">
                                                    <p class="mb-4 fs-sm fw-bold">
                                                        <a class="text-body" href="{{ route('front.product',$orderItem->slug) }}">{{ $orderItem->name }} x {{ $orderItem->qty }}</a> <br>
                                                        <span class="text-muted">{{ $orderItem->total }} Tk</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="card card-lg mb-5 mt-3">
                        <div class="card-body">
                            <!-- Heading -->
                            <h6 class="mt-0 mb-3 h5">Order Total</h6>

                            <!-- List group -->
                            <ul>
                                <li class="list-group-item d-flex">
                                    <span>Subtotal</span>
                                    <span class="ms-auto">{{ number_format($orderInfo->subtotal, 2) }} Tk</span>
                                </li>
                                @if(!empty($orderInfo->coupon_code))
                                    <li class="list-group-item d-flex">
                                        <span>Discount({{ $orderInfo->coupon_code }})</span>
                                        <span class="ms-auto">{{ $orderInfo->discount }} Tk</span>
                                    </li>
                                @endif
                                <li class="list-group-item d-flex">
                                    <span>Shipping</span>
                                    <span class="ms-auto">{{ number_format($orderInfo->shipping,2) }} Tk</span>
                                </li>
                                <li class="list-group-item d-flex fs-lg fw-bold">
                                    <span>Total</span>
                                    <span class="ms-auto">{{ number_format($orderInfo->grand_total,2) }} Tk</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
