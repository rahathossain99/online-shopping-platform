@extends('admin.layouts.app')

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Product</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <form action="" method="put" id="productForm" name="productForm">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="title">Title</label>
                                                <input type="text" value="{{ $product->title }}" name="title" id="title" class="form-control" placeholder="Title">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="slug">Slug</label>
                                                <input type="text" value="{{ $product->slug }}" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Short Description</label>
                                                <textarea name="short_description" value="{{ $product->description }}" id="short_description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" value="{{ $product->description }}" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Media</h2>
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="product-gallery">
                                @if($productImages->isNotEmpty())
                                    @foreach($productImages as $productImage)
                                        <div class="col-md-3" id="image-row-{{$productImage->id}}">
                                            <div class="card">
                                                <input type="hidden" name="image_array[]" value="{{$productImage->id}}">
                                                <img src="{{ asset('uploads/product/small/'.$productImage->image) }}" class="card-img-top" alt="">
                                                <div class="card-body">
                                                    <a href="javascript:void(0)" onclick="deleteImage({{$productImage->id}})" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Pricing</h2>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="price">Price</label>
                                                <input type="text" value="{{ $product->price }}" name="price" id="price" class="form-control" placeholder="Price">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="compare_price">Compare at Price</label>
                                                <input type="text" value="{{ $product->compare_price }}" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                                <p class="text-muted mt-3">
                                                    To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Inventory</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="sku">SKU (Stock Keeping Unit)</label>
                                                <input type="text" value="{{ $product->sku }}" name="sku" id="sku" class="form-control" placeholder="sku">
                                                <p></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="barcode">Barcode</label>
                                                <input type="text" name="barcode" value="{{ $product->barcode }}" id="barcode" class="form-control" placeholder="Barcode">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="hidden" value="No" name="track_qty">
                                                    <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes" checked>
                                                    <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <input type="number" value="{{ $product->qty }}" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product status</h2>
                                    <div class="mb-3">
                                        <select name="status" id="status" class="form-control">
                                            <option {{($product->status=='1') ? 'selected' : ''}} value="1">Active</option>
                                            <option {{($product->status=='0') ? 'selected' : ''}} value="0">Block</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h2 class="h4  mb-3">Product category</h2>
                                    <div class="mb-3">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @if($categories->isNotEmpty())
                                                @foreach($categories as $category)
                                                    <option {{($category->id==$product->category_id) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category">Sub category</label>
                                        <select name="sub_category" id="sub_category" class="form-control">
                                            <option value="">Select a Sub Category</option>
                                            @if($subCategories->isNotEmpty())
                                                @foreach($subCategories as $subCategory)
                                                    <option {{($product->sub_category_id==$subCategory->id) ? 'selected' : ''}} value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Product brand</h2>
                                    <div class="mb-3">
                                        <select name="brand"  id="brand" class="form-control">
                                            <option value="">Select a Brand</option>
                                            @if($brands->isNotEmpty())
                                                @foreach($brands as $brand)
                                                    <option {{($brand->id==$product->brand_id) ? 'selected' : ''}} value="{{ $product->brand_id }}">{{ $brand->name }}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Featured product</h2>
                                    <div class="mb-3">
                                        <select name="is_featured" id="is_featured" class="form-control">
                                            <option {{($product->is_featured=='No') ? 'selected' : ''}} value="No">No</option>
                                            <option {{($product->is_featured=='Yes') ? 'selected' : ''}} value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h2 class="h4 mb-3">Related Products</h2>
                                    <div class="mb-3">
                                        <select multiple class="related-products w-100" name="related_products[]" id="related_products">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('customJs')
    <script>
        //
        $('.related-products').select2({
            ajax:{
                url:'{{ route('products.getProducts') }}',
                dataType:'json',
                tags:true,
                muliple:true,
                minimumInputLength: 3,
                processResults: function(data){
                    return{
                        results:data.tags
                    }
                }
            }
        })

        //summernote generator
        $(document).ready(function(){
            $('.summernote').summernote({
                height:250
            });
        });

        //product form submission
        $('#productForm').submit(function (event) {
            event.preventDefault();
            var element = $(this);
            $.ajax({
                url: '{{ route("products.update",$product->id) }}',
                type: 'put',
                data: element.serializeArray(),
                dataType: 'json',
                success: function (response) {
                    if(response['status']==true){
                        window.location.href='{{ route('products.index') }}';

                    }else {
                        var errors = response['errors'];
                        $('input[type=text],input[type=number],select').removeClass('is-invalid').addClass('is-valid').siblings('p').
                        removeClass('invalid-feedback').addClass('valid-feedback').html("Looks good!");

                        $.each(errors, function (key, value) {
                            var key = '#' + key;
                            $(key).addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(value);

                        });
                    }
                },
                error:function (jqXHR,exception) {
                    console.log("Something went wrong");
                }
            });
        });

        //getting sub-categories
        $('#category').change(function () {
            var category_id=$(this).val();
            $.ajax({
                url: '{{ route("product-subcategories.index") }}',
                type: 'get',
                data: {category_id:category_id},
                dataType: 'json',
                success: function (response) {
                    $('#sub_category').find('option').not(':first').remove();
                    $.each(response['subCategories'],function (key,item) {
                        $('#sub_category').append(`<option value="${item.id}">${item.name}</option>`);
                    });
                }
            });
        });

        // slug generation
        $('#title').change(function () {
            var element=$(this);
            $('button[type=submit]').prop('disabled',true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: {title:element.val()},
                dataType: 'json',
                success: function (response) {
                    if(response['status']==true){
                        $('button[type=submit]').prop('disabled',false);
                        $('#slug').val(response['slug']);
                    }
                }
            });
        });

        //image id generator
        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 10,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                var html=`<div class="col-md-3" id="image-row-${response.image_id}">
                            <div class="card" ">
                             <input type="hidden" name="image_array[]" value="${response.image_id}">
                            <img src="${response.imagePath}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                            </div>`
                $('#product-gallery').append(html);
            },
            complete:function(file)
            {
                this.removeFile(file);
            }
        });

        function deleteImage(id)
        {
            var url='{{ route("product-image.delete","ID") }}'
            var newUrl=url.replace('ID',id);
            $.ajax({
                url:newUrl ,
                type: 'delete',
                data: {},
                dataType: 'json',
                success: function (response) {
                    if(response['status']==true){
                        $('#slug').val(response['slug']);
                    }
                }
            });
            $('#image-row-'+id).remove();
        }
    </script>
@endsection

