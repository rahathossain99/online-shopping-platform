@extends('admin.layouts.app')

@section('navbar')
    <ol class="breadcrumb p-0 m-0 bg-white">
        <li class="breadcrumb-item"><a href="{{ route('shippings.index') }}">Shipping</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
@endsection

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                @include("admin.message")
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Shipping Management</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('shippings.create') }}" class="btn btn-primary">New Shipping</a>
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
                    <form action="{{ route('shippings.index') }}" method="get">
                        <div class="card-header">
                            <div class="card-title">
                                <button type="button" onclick="window.location.href='{{ route('shippings.index') }}'" class="btn btn-default btn-sm">Reset</button>
                            </div>
                            <div class="card-tools">
                                <div class="input-group input-group" style="width: 250px;">
                                    <input type="text" value="{{ Request::get('keyword') }}" name="keyword" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap ">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            @if(!empty($shippingCharges))
                                @foreach($shippingCharges as $shippingCharge)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{($shippingCharge->country_id=='rest_of_world') ? 'Rest Of The World' : $shippingCharge->name}}
                                        </td>
                                        <td>{{ $shippingCharge->amount }}</td>
                                        <td>
                                            <a href="{{ route('shippings.edit',$shippingCharge->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="javascript:void(0)" onclick="deleteShipping({{ $shippingCharge->id }})" class="btn btn-danger btn-sm">Delete</a>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        {{ $shippingCharges->links() }}
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>

@endsection


<!---custom js---->
@section('customJs')

    <script>
        function deleteShipping(id) {
            var url='{{ route('shippings.destroy','ID') }}';
            var newUrl=url.replace('ID',id);
            $.ajax({
                url:newUrl,
                type:'delete',
                data:{},
                dataType:'json',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(response){
                    window.location.href='{{ route('shippings.index') }}';
                },error:function (jqXHR,exception) {
                    console.log("Something went wrong");
                }
            })
        }
    </script>

@endsection
