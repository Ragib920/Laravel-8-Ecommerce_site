@extends('AdminLayouts.app')

@section('title','Brand')
@section('brand_select','active')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Brand</h2>
                            <a  href="{{url('admin/brand/manage_brand')}}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Brand</a>
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
                                    <th>ID</th>
                                    <th>Brand</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $list)
                                    <tr>
                                        <td>{{$list->id}}</td>
                                        <td>{{$list->name}}</td>
                                        <td>
                                            @if($list->image!='')
                                                <img width="100px" src="{{asset('storage/media/brand/'.$list->image)}}"/>
                                            @endif
                                        </td>
                                        <td>
                                            @if($list->status==1)
                                                <a href="{{url('admin/brand/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-success btn-sm ">Activated</button></a>
                                            @elseif($list->status==0)
                                                <a href="{{url('admin/brand/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning btn-sm">Deactivated</button></a>
                                            @endif
                                            <a class="btn btn-info" href="{{url('admin/brand/manage_brand/')}}/{{$list->id}}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger" href="{{url('admin/brand/deleteBrand/')}}/{{$list->id}}"><i class="fas fa-trash-alt"></i></button></a>
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
