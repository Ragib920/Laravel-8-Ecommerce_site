@extends('AdminLayouts.app')
@section('title','Customer')
@section('customer_select','active')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Customer</h2>
{{--                            <a  href="{{url('admin/category/manage_category')}}" class="au-btn au-btn-icon au-btn--blue">--}}
{{--                                <i class="zmdi zmdi-plus"></i>Add Customer</a>--}}
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Mobile </th>
                                    <th>Email </th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as  $data)
                                    <tr>

                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->mobile }}</td>
                                        <td>{{$data->email}}</td>
                                        <td>{{$data->address}}</td>
                                        <td>{{$data->city}}</td>
                                        <td>
                                            @if($data->status==1)
                                                <a href="{{url('admin/customer/status/0')}}/{{$data->id}}" class="btn-success btn-sm"> Activated</a>
                                            @elseif($data->status==0)
                                                <a href="{{url('admin/customer/status/1')}}/{{$data->id}}" class="btn btn-warning btn-sm">Deactivated</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('admin/customer/show/')}}/{{$data->id}}"><button type="button" class="btn btn-success">View</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- END DATA TABLE-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('script')
    @if(Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>
    @endif
@endsection
