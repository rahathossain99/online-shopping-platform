@extends("admin.layouts.app")

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('enterprise.info') }}">Enterprise</a></li>
        <li class="breadcrumb-item active">Set</li>
    </ol>
@endsection

@section("content")
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Enterprise Information</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('enterprise.info') }}" class="btn btn-primary">Back</a>
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
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th >Email</th>
                                <th >Phone</th>
                                <th >Country</th>
                                <th >City</th>
                                <th >Zip</th>
                                <th >Street</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($info))
                                <tr>
                                    <td>{{ $info->email }}</td>
                                    <td>{{ $info->mobile }}</td>
                                    <td>{{ $info->country }}</td>
                                    <td>{{ $info->city }}</td>
                                    <td>{{ $info->zip }}</td>
                                    <td>{{ $info->street }}</td>
                                </tr>

                            @else
                                <tr>
                                    <td colspan="5">Records Not Found</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <section class="content-header">
                    @include('admin.message')
                    <div class="container-fluid my-2">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Update Information</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <form action="{{ route("enterprise.storeOrUpdate") }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old("email") }}" placeholder="Email">
                                        @error('email')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" name="mobile" id="mobile" class="form-control @error('mobile') is-invalid @enderror" value="{{ old("mobile") }}" placeholder="Mobile No.">
                                        @error('mobile')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                                            <option value="">Select a Country</option>
                                            @if($countries->isNotEmpty())
                                                @foreach($countries as $country)
                                                    <option  value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('country')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
{{--                                {{ ($info->country==$country->id) ? 'selected' : ''}}--}}

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old("city") }}" placeholder="City">
                                        @error('city')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" name="street" id="street" value="{{ old("street") }}" class="form-control" placeholder="Street">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <input type="text" name="zip" id="zip" class="form-control @error('zip') is-invalid @enderror" value="{{ old("zip") }}" placeholder="Zip">
                                        @error('zip')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary">Set</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection

