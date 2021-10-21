@extends('AdminLayouts.app')

@section('title','Coupons')
@section('coupon_select','active')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Coupons</h2>
                            <a  href="{{url('admin/coupon/manage_coupon')}}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Coupon</a>
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
                                    <th>No</th>
                                    <th>Coupon Title</th>
                                    <th>Coupon Code</th>
                                    <th>Coupon Value</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $key=> $data)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->code }}</td>
                                        <td>{{ $data->value }}</td>
                                        <td>
                                            <a href="{{url('admin/coupon/manage_coupon/')}}/{{$data->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>
                                            <a href="{{url('admin/coupon/deleteCoupon/')}}/{{$data->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                        {{--                                    <td> <a href="/deleteData/{{ $data->id }}" class="btn btn-danger">Delete</a> </td>--}}

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
