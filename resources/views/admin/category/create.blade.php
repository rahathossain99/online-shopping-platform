@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="#" method="post" id="categoryForm" name="categoryForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6" >
                                <div class="mb-3">
                                    <input type="hidden" name="image_id" id="image_id">
                                    <label for="image">Image</label>
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="new_image">

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status"  id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showHome">Show on Home</label>
                                    <select name="showHome"  id="showHome" class="form-control">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('customJs')
    <script>
        $('#categoryForm').submit(function (event) {
            event.preventDefault();
            var element=$(this);
            $.ajax({
                url:'{{ route("categories.store") }}',
                type:'post',
                data:element.serializeArray(),
                dataType:'json',
                success:function (response) {
                    if(response['status']==true){
                        window.location.href='{{ route('categories.index') }}';
                    }else{
                        var errors=response['errors'];
                        if(errors['name']){
                            $('#name').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['name']);
                        }else{
                            $('#name').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            addClass('valid-feedback').html("Looks good!");
                        }
                        if(errors['slug']){
                            $('#slug').addClass('is-invalid').siblings('p').
                            addClass('invalid-feedback').html(errors['slug']);
                        }else{
                            $('#slug').removeClass('is-invalid').addClass('is-valid').siblings('p').
                            addClass('valid-feedback').html("Looks good!");
                        }
                    }

                },error:function (jqXHR,exception) {
                    console.log("Something went wrong");
                }
            })
        })
        $('#name').change(function () {
            var element=$(this);
            $('button[type=submit]').prop('disabled',true);
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: {title:element.val()},
                dataType: 'json',
                success: function (response) {
                    $('button[type=submit]').prop('disabled',false);
                    if(response['status']==true){
                        $('#slug').val(response['slug']);
                    }
                }
            });
        });

        Dropzone.autoDiscover = false;
        const dropzone = $("#image").dropzone({
            init: function() {
                this.on('addedfile', function(file) {
                    if (this.files.length > 1) {
                        this.removeFile(this.files[0]);
                    }
                });
            },
            url:  "{{ route('temp-images.create') }}",
            maxFiles: 1,
            paramName: 'image',
            addRemoveLinks: true,
            acceptedFiles: "image/jpeg,image/png,image/gif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, success: function(file, response){
                var html=`<div class="card" id="get_image">
                             <input type="hidden" name="image_id" value="${response.image_id}">
                            <img src="${response.imagePath}" class="card-img-top" alt="">
                                <div class="card-body">
                                    <a href="javascript:void(0)" onclick="deleteImage()" class="btn btn-danger">Delete</a>
                                </div>
                            </div>
                          </div>`
                $('#new_image').append(html);

            },
            complete:function(file)
            {
                this.removeFile(file);
            }
        });
        function deleteImage()
        {
            $('#get_image').remove();
        }
    </script>
@endsection
