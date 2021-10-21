@extends('AdminLayouts.app')

@section('title','Size')
@section('size_select','active')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Size</h2>
                            <a  href="{{url('admin/size/manage_size')}}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Size</a>
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
                                    <th>Size </th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $key=> $data)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $data->size }}</td>
                                        <td>
                                            @if($data->status==1)
                                                <a href="{{url('admin/size/status/0')}}/{{$data->id}}" class="btn-success btn-sm"> Activated</a>
                                            @elseif($data->status==0)
                                                <a href="{{url('admin/size/status/1')}}/{{$data->id}}" class="btn btn-warning btn-sm">Deactivated</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('admin/size/manage_size/')}}/{{$data->id}}" class="btn btn-info"> <i class="fas fa-edit"></i></a>
                                            <a href="{{url('admin/size/deleteSize/')}}/{{$data->id}}" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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
