@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('pages.index') }}">Pages</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Page</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('pages.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{ route('pages.update',$page->id) }}" method="post" >
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ empty(old('name')) ? $page->name : old('name') }}" placeholder="Name">
                                        @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Slug</label>
                                        <input type="text" readonly name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ empty(old('slug')) ? $page->slug : old('slug') }}" placeholder="Slug">
                                        @error('slug')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="page_content">Content</label>
                                        <textarea name="page_content" id="page_content" class="summernote" cols="30" rows="10">{{ $page->content }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pb-5 pt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
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
        $(function () {
            // Summernote
            $('.summernote').summernote({
                height: '300px'
            });
        });

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
    </script>
@endsection





