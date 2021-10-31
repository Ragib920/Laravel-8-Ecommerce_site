@extends('AdminLayouts.app')

@section('title','Tax')
@section('tax_select','active')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">Tax</h2>
                            <a  href="{{url('admin/tax/manage_tax')}}" class="au-btn au-btn-icon au-btn--blue">
                                <i class="zmdi zmdi-plus"></i>Add Tax</a>
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
                                    <th>Tax Value</th>
                                    <th>Tax Desc</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $list)
                                    <tr>
                                        <td>{{$list->tax_desc}}</td>
                                        <td>{{$list->tax_value}}</td>

                                        <td>
                                            @if($list->status==1)
                                                <a href="{{url('admin/tax/status/0')}}/{{$list->id}}"><button type="button" class="btn btn-success btn-sm ">Activated</button></a>
                                            @elseif($list->status==0)
                                                <a href="{{url('admin/tax/status/1')}}/{{$list->id}}"><button type="button" class="btn btn-warning btn-sm">Deactivated</button></a>
                                            @endif
                                            <a class="btn btn-info" href="{{url('admin/tax/manage_tax/')}}/{{$list->id}}"><i class="fas fa-edit"></i></a>
                                            <a class="btn btn-danger" href="{{url('admin/tax/deleteTax/')}}/{{$list->id}}"><i class="fas fa-trash-alt"></i></button></a>
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
