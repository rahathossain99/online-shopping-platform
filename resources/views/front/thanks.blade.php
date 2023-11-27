@extends('front.layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 text-center py-5">
            <h1>Thanks {{ $customer }} !</h1>
            <p>Your Order Id is:{{ $id }}</p>
        </div>
    </div>
@endsection
