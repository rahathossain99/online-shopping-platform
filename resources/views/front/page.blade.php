@extends('front.layouts.app')

@section('content')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item active" href="{{ route('front.page',$page->slug) }}">{{ $page->name }}</li>
                </ol>
            </div>
        </div>
    </section>

    @if($page->slug=='contact-us')
        <section class=" section-10">
            <div class="container">
                <div class="section-title mt-5 ">
                    <h2>{{ $page->name }}</h2>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                        @endif
                    </div>
                    <div class="col-md-6 mt-3 pe-lg-5">
                        <p>{!! $page->content !!}</p>
                        <address>
                            {{ enterpriseInfo()->street }}<br>
                            {{ enterpriseInfo()->city }} {{ enterpriseInfo()->zip }}<br>
                            <a href="tel:+xxxxxxxx">{{ enterpriseInfo()->mobile }}</a><br>
                            <a href="{{ enterpriseInfo()->email }}">{{ enterpriseInfo()->email }}</a>
                        </address>
                    </div>

                    <div class="col-md-6">
                        <form action="{{ route('front.mailContact') }}" class="shake" role="form" method="post" id="contactForm" name="contact-form">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-2" for="name">Name</label>
                                <input class="form-control  @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}"  data-error="Please enter your name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="mb-2" for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" value="{{ old('email') }}"   data-error="Please enter your Email">
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="mb-2">Subject</label>
                                <input class="form-control @error('subject') is-invalid @enderror" id="msg_subject" type="text" name="subject" value="{{ old('subject') }}"   data-error="Please enter your message subject">
                                @error('subject')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="mb-2">Message</label>
                                <textarea class="form-control" rows="3" id="message" name="message"  data-error="Write your message"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-submit">
                                <button class="btn btn-dark" type="submit" id="form-submit"><i class="material-icons mdi mdi-message-outline"></i> Send Message</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="section-6">
            <div class="container my-3">
                <h1>{{ $page->name }}</h1>
                {!! $page->content !!}
            </div>
        </section>
    @endif
@endsection


