@extends('front.layouts.app')

@section('content')

        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                        <li class="breadcrumb-item active" href="{{ route('front.shop') }}">Shop</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-6 pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 sidebar">
                        <div class="sub-title">
                            <h2>Categories</h2>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="accordionExample">
                                    @if($categories->isNotEmpty())
                                        @foreach($categories as $category)
                                            <div class="accordion-item">
                                                @if($category->sub_categories->isNotEmpty())
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $category->id }}" aria-expanded="false" aria-controls="collapseOne">
                                                            {{ $category->name }}
                                                        </button>
                                                    </h2>
                                                @else
                                                    <a href="" class="nav-item nav-link">{{ $category->name }}</a>
                                                @endif
                                                    <div id="collapseOne-{{ $category->id }}" class="accordion-collapse collapse {{ ($categorySelectedId==$category->id) ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                                        <div class="accordion-body">
                                                            <div class="navbar-nav">
                                                                @foreach($category->sub_categories as $subCategory)
                                                                    <a href="{{ route('front.shop',[$category->slug,$subCategory->slug]) }}" class="nav-item nav-link {{ ($subCategorySelectedId==$subCategory->id) ? 'text-primary' : '' }} ">{{ $subCategory->name }}</a>
                                                                 @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="sub-title mt-5">
                            <h2>Brand</h2>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                @if($brands->isNotEmpty())
                                    @foreach($brands as $brand)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input brand-label" type="checkbox" {{ ($brandSelectedId==$brand->id) ? 'checked' : ''}} name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="sub-title mt-5">
                            <h2>Price</h2>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <input type="text" class="js-range-slider" name="my_range" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row pb-3">
                            <div class="col-12 pb-1">
                                <div class="d-flex align-items-center justify-content-end mb-4">
                                    <div class="ml-2">
{{--                                        <div class="btn-group">--}}
{{--                                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">Sorting</button>--}}
{{--                                            <div class="dropdown-menu dropdown-menu-right">--}}
{{--                                                <a class="dropdown-item" href="#">Latest</a>--}}
{{--                                                <a class="dropdown-item" href="#">Price High</a>--}}
{{--                                                <a class="dropdown-item" href="#">Price Low</a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <select class="form-control" name="sort" id="sortBy">
                                            <option value="latest" {{ ($sortSelected=='latest') ? 'selected' : '' }}>Latest</option>
                                            <option value="price_high" {{ ($sortSelected=='price_high') ? 'selected' : '' }}>Price High</option>
                                            <option value="price_low" {{ ($sortSelected=='price_low') ? 'selected' : '' }}>Price Low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @if($products->isNotEmpty())
                                @foreach($products as $product)
                                    <div class="col-md-3">
                                        <div class="card product-card">
                                            <div class="product-image position-relative">
                                                <a href="{{ route('front.product',$product->slug) }}" class="product-img"><img class="card-img-top" src="{{ asset('uploads/product/small/'.$product->product_image->image) }}" alt=""></a>
                                                <a class="whishlist" href="javascript:void(0)" onclick="addToWishlist({{ $product->id }})"><i class="fas fa-heart" ></i></a>
                                                <div class="product-action">
                                                    <a class="btn btn-dark"  href="javascript:void(0)" onclick="addToCart({{ $product->id }})">
                                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-body text-center mt-3">
                                                <a class="h6 link" href="{{ route('front.product',$product->slug) }}">{{ (strlen($product->title)<20) ? $product->title : substr($product->title,0,16).'..' }}</a>
                                                <div class="price mt-2">
                                                    <span class="h5"><strong>{{ $product->price }} Tk</strong></span>
                                                    @if($product->compare_price>0)
                                                    </br>
                                                    <span class="h6 text-underline"><del>{{ $product->compare_price }} Tk</del></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body d-flex justify-content-center align-items-center">
                                            <h4>Products Not Found</h4>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-md-12 pt-5">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('customJs')
    <script>

         rangeSlider=$('.js-range-slider').ionRangeSlider({
             type: "double",
             min: 1,
             max: 150000,
             from: {{ $priceMin }},
             step: 25,
             to: {{ $priceMax }},
             skin: "round",
             max_postfix: "+",
             postfix: " Tk",
             onFinish: function () {
                 apply_filter();
             }
         });
         var slider=$(".js-range-slider").data("ionRangeSlider");

         $("#sortBy").change(function () {
            apply_filter();
         });


        $(".brand-label").change(function (){
            var url='{{ url()->current() }}?';
            if($(this).is(':checked')){
                window.location.href=url+'&brand='+$(this).val();
            }
            else{
                window.location.href=url;
            }
        });

        function apply_filter(val=null) {
            var url='{{ url()->current() }}?';
            url=url+'&price_min='+slider.result.from+'&price_max='+slider.result.to;
            if($('.brand-label').is(':checked'))
            {
                url=url+'&brand='+'{{ Request::get('brand') }}';
            }
            var srt=$("#sortBy").val();
            if(srt!=='latest')
            {
                url=url+'&sort-by='+srt;
            }
            var src=$('#search').val();
            if(src.length>0)
            {
                url=url+'&search='+src;
            }
            window.location.href=url;
        }

         function addToCart(id)
         {
             $.ajax({
                 url:'{{ route('front.addToCart') }}',
                 type:'post',
                 data:{id:id},
                 dataType:'json',
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 success:function (response) {
                     if(response.status==true){
                         window.location.href='{{ route('front.cart') }}';
                     }else{
                         alert(response.message);
                     }
                 }
             });
         }

   </script>
@endsection
