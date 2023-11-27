@extends('front.layouts.app')

@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.shop') }}">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form action="{{ route("front.checkoutStore") }}" method="post" id="orderForm">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="sub-title">
                            <h2>Shipping Address</h2>
                        </div>
                        <div class="card shadow-lg border-0">
                            <div class="card-body checkout-form">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="first_name" id="first_name" value="{{ (!empty($customerAddress)) ? $customerAddress->first_name : ''}}" class="form-control" placeholder="First Name">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="last_name" id="last_name" value="{{ (!empty($customerAddress)) ? $customerAddress->last_name : ''}}" class="form-control" placeholder="Last Name">
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="email" id="email" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->email : ''}}" placeholder="Email">
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Select a Country</option>
                                                @if($countries->isNotEmpty())
                                                    @foreach($countries as $country)
                                                        <option {{ ($customerAddress->country_id==$country->id) ? 'selected' : ''}} value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                        <option value="rest_of_world">Rest of The World</option>
                                                @endif
                                            </select>
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->address : ''}}"></textarea>
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="apartment" id="apartment" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->apartment : ''}}" placeholder="Apartment, suite, unit, etc. (optional)">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="city" id="city" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->city : ''}}" placeholder="City">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" name="zip" id="zip" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->zip : ''}}" placeholder="Zip">
                                            <p></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ (!empty($customerAddress)) ? $customerAddress->mobile : ''}}" placeholder="Mobile No.">
                                            <p></p>
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <textarea name="order_notes" id="order_notes" cols="30" rows="2" value="" placeholder="Order Notes (optional)" class="form-control"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sub-title">
                            <h2>Order Summery</h2>
                        </div>
                        <div class="card cart-summery">
                            <div class="card-body">
                                @foreach(Cart::content() as $item)
                                    <div class="d-flex justify-content-between pb-2">
                                        <div class="h6">{{ $item->name }} X {{ $item->qty }}</div>
                                        <div class="h6">{{ $item->qty*$item->price }} Tk</div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>Subtotal</strong></div>
                                    <div class="h6"><strong>{{ Cart::subtotal() }} Tk</strong></div>
                                </div>
                                <div class="d-flex justify-content-between summery-end">
                                    <div class="h6"><strong>Discount</strong></div>
                                    <div class="h6"><strong id="discount">{{ number_format($discount) }} Tk</strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="h6"><strong>Shipping</strong></div>
                                    <div class="h6"><strong id="shipping_charge">{{ number_format($totalShippingCharge,2) }} Tk</strong></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 summery-end">
                                    <div class="h5"><strong>Total</strong></div>
                                    <div class="h5"><strong id="grand_total">{{ number_format($grandToltal,2) }} Tk</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group coupon-code mt-5">
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Coupon Code">
                            <button type="button" class="btn btn-dark" id="coupon_code_apply">Apply Code</button>
                        </div>
                        <div id="discount-response">
                            @if(Session::has('code'))
                                <div id="coupon">
                                    <div class="input-group mt-4">
                                        <strong id="coupon_session">{{ Session::get('code')->code }}</strong>
                                        <button type="button" class="btn btn-danger btn-sm ms-1" id="coupon_code_delete">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card payment-form ">
                            <h3 class="card-title h5 mb-3">Payment Method</h3>
                            <div class="">
                                <input checked type="radio" name="payment_method" value="cod" id="payment_method_one">
                                <label for="payment_method_one" class="form-check-label">Cash On Delivary</label>
                            </div>
                            <div class="">
                                <input type="radio" name="payment_method" value="stripe" id="payment_method_two">
                                <label for="payment_method_two" class="form-check-label">Stripe</label>
                            </div>
                            <div class="pt-4">
                                <button type="submit" class="btn-dark btn btn-block w-100">Proceed</button>
                            </div>
                        </div>


                        <!-- CREDIT CARD FORM ENDS HERE -->

                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@section('customJs')
    <script>
        $('#payment_method_one').click(function () {
            if($(this).is(':checked')==true)
            {
                $('#card_payment_form').addClass('d-none');
            }
        });

        $('#payment_method_two').click(function () {
            if($(this).is(':checked')==true)
            {
                $('#card_payment_form').removeClass('d-none');
            }
        });

        $('#country').change(function () {
            $.ajax({
                url: '{{ route("front.getShippingAmount") }}',
                type: 'post',
                data: {country_id:$(this).val() },
                datatype: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#shipping_charge').html(response.totalShippingCharge+' Tk');
                    $('#grand_total').html(response.grandToltal+' Tk');
                    $('#discount').html(response.discount+' Tk');
                }
            });
        });

        $('#coupon_code_apply').click(function () {
            $.ajax({
                url: '{{ route("front.applyCoupon") }}',
                type: 'post',
                data: {code:$('#coupon_code').val(),country_id:$('#country').val() },
                datatype: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.status==true)
                    {
                        // $('#coupon').removeClass('d-none');
                        $('#shipping_charge').html(response.totalShippingCharge+' Tk');
                        $('#grand_total').html(response.grandToltal+' Tk');
                        $('#discount').html(response.discount+' Tk');
                        $('#discount-response').html(response.discountString);
                        $('#coupon_code').val('');
                    }else{
                        $('#discount-response').html("<span class='text-danger'>"+response.message+"</span>");

                    }
                }
            });
        });

        {{--$('#orderForm').submit(function (event) {--}}
        {{--    event.preventDefault();--}}
        {{--    $.ajax({--}}
        {{--        url:'{{ route("front.payment") }}',--}}
        {{--        type:'post',--}}
        {{--        data:$(this).serializeArray(),--}}
        {{--        datatype:'json',--}}
        {{--        headers: {--}}
        {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
        {{--        },--}}
        {{--        success:function(response){--}}
        {{--            if(response.status==true)--}}
        {{--            {--}}
        {{--                var url='{{ route("front.thanks","ID") }}';--}}
        {{--                var newUrl=url.replace("ID",response.id)--}}
        {{--                window.location.href=newUrl;--}}
        {{--            }else{--}}
        {{--                $('input[type=text], select').not("#apartment").removeClass('is-invalid').addClass('is-valid')--}}
        {{--                    .siblings('p').removeClass('invalid-feedback').addClass('valid-feedback').html('Looks good!')--}}
        {{--                $.each(response['error'],function (key,item) {--}}
        {{--                    $(`#${key}`).addClass('is-invalid').siblings('p').--}}
        {{--                    addClass('invalid-feedback').html(item)--}}
        {{--                })--}}
        {{--            }--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}

        $('body').on('click','#coupon_code_delete',function () {
            $.ajax({
                url: '{{ route("front.deleteCoupon") }}',
                type: 'post',
                data: {country_id:$('#country').val()},
                datatype: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if(response.status==true){
                        $('#discount-response').html('');
                        $('#shipping_charge').html(response.totalShippingCharge+' Tk');
                        $('#grand_total').html(response.grandToltal+' Tk');
                        $('#discount').html(response.discount+' Tk');
                    }
                }
            });
        })
        // $('#coupon_code_delete').click(function () {
        //
        // });
    </script>
@endsection
