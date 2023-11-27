<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Email</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif;font-size: 16px">
    <h1>Thanks for your order!!</h1>
    <p>Your order Id is:#{{ $mailData['order']->id }}</p>
{{--    <div class="col-sm-4 invoice-col">--}}
{{--        <h1 class="h5 mb-3">Shipping Address</h1>--}}
{{--        <address>--}}
{{--            <strong>{{ $orderInfo->first_name.' '.$orderInfo->last_name }}</strong><br>--}}
{{--            {{ $orderInfo->address }}<br>--}}
{{--            {{ $orderInfo->city }}, C{{ $orderInfo->zip }}<br>--}}
{{--            Phone: (804) {{ $orderInfo->mobile }} <br>--}}
{{--            Email: {{ $orderInfo->email }}--}}
{{--        </address>--}}
{{--    </div>--}}
    <h2>Products</h2>
    <table cellpadding="3" cellspacing="3" border="0">
        <thead>
        <tr style="background: #ccc">
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
{{--        @if($mailData['order']->isNotEmpty())--}}
            @foreach($mailData['order']->orderedProduct as $orderedProduct)
                <tr>
                    <td>{{ $orderedProduct->name }}</td>
                    <td>{{ $orderedProduct->price }} Tk</td>
                    <td>{{ $orderedProduct->qty }}</td>
                    <td>{{ $orderedProduct->total }} Tk</td>
                </tr>
            @endforeach
{{--        @endif--}}
        <tr>
            <th colspan="3" align="right">Subtotal:</th>
            <td>{{ $mailData['order']->subtotal }} Tk</td>
        </tr>
        <tr>
            <th colspan="3" align="right">Discount{{ (!empty($mailData['order']->coupon_code)) ? '('.$mailData['order']->coupon_code.')' : ''}}</th>
            <td>{{ $mailData['order']->discount }} Tk</td>
        </tr>
        <tr>
            <th colspan="3" align="right">Shipping:</th>
            <td>{{ $mailData['order']->shipping }} Tk</td>
        </tr>
        <tr>
            <th colspan="3" align="right">Grand Total:</th>
            <td>{{ $mailData['order']->grand_total }} Tk</td>
        </tr>
        </tbody>
    </table>
</body>
</html>
