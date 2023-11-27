@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="">Settings</a></li>
        <li class="breadcrumb-item active">Change Password</li>
    </ol>
@endsection

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.message')
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Change Password</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('admin.changePasswordProcess') }}" method="post">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">Old Password</label>
                                            <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control @error('old_password') is-invalid @enderror">
                                            @error('old_password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">New Password</label>
                                            <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control @error('new_password') is-invalid @enderror">
                                            @error('new_password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="name">Confirm Password</label>
                                            <input type="password" name="confirm_password" id="confirm_password" placeholder="New Password" class="form-control @error('confirm_password') is-invalid @enderror">
                                            @error('confirm_password')
                                                <p class="invalid-feedback">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex pb-5 pt-3">
                                        <button type="submit" class="btn btn-dark">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection
