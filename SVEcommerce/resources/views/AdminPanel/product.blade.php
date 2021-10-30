@extends('AdminLayouts.app')

@section('title','Product')
@section('product_select','active')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Product</h2>
                            <a  href="{{url('admin/product/manage_product')}}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Product</a>
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-md-12">
{{--                        <!-- DATA TABLE-->--}}
{{--                        <div class="table-responsive m-b-40">--}}
{{--                            <table class="table table-borderless table-data3">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>No</th>--}}
{{--                                    <th>Image </th>--}}
{{--                                    <th>Name </th>--}}
{{--                                    <th>Slug </th>--}}
{{--                                    <th>Category ID </th>--}}
{{--                                    <th>Brand </th>--}}
{{--                                    <th>Model </th>--}}
{{--                                    <th>Short Description </th>--}}
{{--                                    <th>Description </th>--}}
{{--                                    <th>Keywords </th>--}}
{{--                                    <th>Technical Specification </th>--}}
{{--                                    <th>Uses </th>--}}
{{--                                    <th>Warranty </th>--}}
{{--                                    <th>Status</th>--}}
{{--                                    <th>Action</th>--}}
{{--                                    <th></th>--}}

{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($result as $key=> $data)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{ $key+1 }}</td>--}}
{{--                                        <td>--}}
{{--                                            <img  src=" {{asset('storage/media/'.$data->image)}} " alt=""/>--}}
{{--                                        </td>--}}
{{--                                        <td>{{ $data->name }}</td>--}}
{{--                                        <td>{{ $data->slug }}</td>--}}
{{--                                        <td>{{ $data->category_id }}</td>--}}
{{--                                        <td>{{ $data->brand }}</td>--}}
{{--                                        <td>{{ $data->model }}</td>--}}
{{--                                        <td>{{ $data->short_desc }}</td>--}}
{{--                                        <td>{{ $data->desc }}</td>--}}
{{--                                        <td>{{ $data->keywords }}</td>--}}
{{--                                        <td>{{ $data->technical_specification }}</td>--}}
{{--                                        <td>{{ $data->uses }}</td>--}}
{{--                                        <td>{{ $data->warranty }}</td>--}}
{{--                                        <td>--}}
{{--                                            @if($data->status==1)--}}
{{--                                                <a href="{{url('admin/product/status/0')}}/{{$data->id}}" class="btn-success btn-sm"> Activated</a>--}}
{{--                                            @elseif($data->status==0)--}}
{{--                                                <a href="{{url('admin/product/status/1')}}/{{$data->id}}" class="btn btn-warning btn-sm">Deactivated</a>--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{url('admin/product/manage_product/')}}/{{$data->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{url('admin/product/deleteProduct/')}}/{{$data->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <!-- END DATA TABLE-->--}}


                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <thead>
                                <tr>
                                    <th>Image </th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $key=> $data)
                                    <tr>
                                        <td>
                                            <img  src=" {{asset('storage/media/'.$data->image)}} " width="90px;" alt=""/>
                                        </td>
                                        <td>
                                            <h4>{{$data->name}}</h4>
                                            <div class="row  pt-3">
                                                <div class="col-md-4">
{{--                                                    <p>Category:</p>--}}
                                                    <p>Brand:</p>
                                                    <p>Model:</p>
                                                    <p>Warranty:</p>
                                                </div>
                                                <div class="col-md-8">
{{--                                                    <p>{{ $data->category_id }}</p>--}}
                                                    <p>{{ $data->brand }}</p>
                                                    <p>{{ $data->model }}</p>
                                                    <p>{{ $data->warranty }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($data->status==1)
                                                <a href="{{url('admin/product/status/0')}}/{{$data->id}}" class="btn-success btn-sm"> Activated</a>
                                            @elseif($data->status==0)
                                                <a href="{{url('admin/product/status/1')}}/{{$data->id}}" class="btn btn-warning btn-sm">Deactivated</a>
                                            @endif

                                            <a href="{{url('admin/product/manage_product/')}}/{{$data->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>

                                            <a href="{{url('admin/product/deleteProduct/')}}/{{$data->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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
