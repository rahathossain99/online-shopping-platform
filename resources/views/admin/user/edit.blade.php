@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
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
                        <h1>Edit User</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                <form action="{{ route('users.update',$user->id) }}" method="post" >
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" value="{{ $user->name }}" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" value="{{ $user->email }}" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                        @error('email')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" value="{{ $user->phone }}" name="phone" id="phone" class="form-control" placeholder="Phone">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status">Status</label>
                                        <select name="status"  id="status" class="form-control">
                                            <option {{ ($user->status==1) ? 'selected' : '' }} value="1">Active</option>
                                            <option {{ ($user->status==0) ? 'selected' : '' }} value="0">Block</option>
                                        </select>
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

{{--@section('customJs')--}}
{{--    <script>--}}
{{--        $('#categoryForm').submit(function (event) {--}}
{{--            event.preventDefault();--}}
{{--            var element=$(this);--}}
{{--            $.ajax({--}}
{{--                url:'{{ route("categories.update",$category->id) }}',--}}
{{--                type:'put',--}}
{{--                data:element.serializeArray(),--}}
{{--                dataType:'json',--}}
{{--                success:function (response) {--}}
{{--                    if(response['status']==true){--}}
{{--                        window.location.href='{{ route('categories.index') }}';--}}
{{--                    }else{--}}
{{--                        var errors=response['errors'];--}}
{{--                        if(errors['name']){--}}
{{--                            $('#name').addClass('is-invalid').siblings('p').--}}
{{--                            addClass('invalid-feedback').html(errors['name']);--}}
{{--                        }else{--}}
{{--                            $('#name').removeClass('is-invalid').addClass('is-valid').siblings('p').--}}
{{--                            addClass('valid-feedback').html("Looks good!");--}}
{{--                        }--}}
{{--                        if(errors['slug']){--}}
{{--                            $('#slug').addClass('is-invalid').siblings('p').--}}
{{--                            addClass('invalid-feedback').html(errors['slug']);--}}
{{--                        }else{--}}
{{--                            $('#slug').removeClass('is-invalid').addClass('is-valid').siblings('p').--}}
{{--                            addClass('valid-feedback').html("Looks good!");--}}
{{--                        }--}}
{{--                    }--}}

{{--                },error:function (jqXHR,exception) {--}}
{{--                    console.log("Something went wrong");--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--        --}}
{{--    </script>--}}
{{--@endsection--}}
