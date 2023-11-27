@extends('admin.layouts.app')

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('sub-categories.index') }}">Sub Category</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection

<!---start main---->
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Sub Category</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('sub-categories.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="" id="subCategoryForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name">Category</label>
                                    <select name="category_id" id="category" class="form-control" >
                                        <option value="">Select a Category</option>
                                        @if($categories->isNotEmpty())
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
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
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('sub-categories.create') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

@endsection
<!---end main---->


<!---start custom js---->
@section('customJs')
<script>
    $('#subCategoryForm').submit(function (event) {
        event.preventDefault();
        var element=$(this);
        $.ajax({
            url:'{{ route("sub-categories.store") }}',
            type:'post',
            data:element.serializeArray(),
            dataType:'json',
            success:function (response) {
                if(response['status']==true){
                    window.location.href='{{ route('sub-categories.index') }}';

                }else{
                    var errors=response['errors'];
                    if(errors['category_id']){
                        $('#category').addClass('is-invalid').siblings('p').
                        addClass('invalid-feedback').html(errors['category_id']);
                    }else{
                        $('#name').removeClass('is-invalid').addClass('is-valid').siblings('p').
                        addClass('valid-feedback').html("Looks good!");
                    }
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

            },
            error:function (jqXHR,exception) {
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
</script>
@endsection
