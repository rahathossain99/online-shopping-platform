@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('user.profile') }}">My Account</a></li>
                    <li class="breadcrumb-item">My Wishlist</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            @if(Session::has('success'))
                <div class="card col-md-6 align-items-center">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            @if(Session::has('error'))
                <div class="card col-md-6 align-items-center">
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    @include('front.account.common.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                        </div>
                        <div class="card-body p-4">
                            @if($wishedItems->isNotEmpty())
                                @foreach($wishedItems as $wishedItem)
                                    <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                        <div class="d-block d-sm-flex align-items-start text-center text-sm-start"><a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('front.product',$wishedItem->slug) }}" style="width: 10rem;"><img src="{{ asset('uploads/product/small/'.getProductImage($wishedItem->id)->image) }}" alt="Product"></a>
                                            <div class="pt-2">
                                                <h3 class="product-title fs-base mb-2"><a href="{{ route('front.product',$wishedItem->slug) }}">{{ $wishedItem->title }}</a></h3>
                                                <div class="fs-lg text-accent pt-2">{{ $wishedItem->price }} Tk</div>
                                            </div>
                                        </div>
                                        <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                            <button class="btn btn-outline-danger btn-sm" type="button" onclick="deleteWishProduct({{ $wishedItem->wishId }})"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        function deleteWishProduct(id) {
            $.ajax({
                url: '{{ route('front.deleteToWishlist') }}',
                type: 'post',
                data: {id: id},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    window.location.href='{{ route("user.myWishlist") }}'
                }
            });
        }
    </script>
@endsection
