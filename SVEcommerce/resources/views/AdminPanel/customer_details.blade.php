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
                            <h2 class="title-1">Customer Details</h2>
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="table-responsive m-b-40">
                            <table class="table table-borderless table-data3">
                                <tbody>
                                <tr>
                                    <td><strong>Name</strong></td>
                                    <td>{{$customer_list->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{$customer_list->email}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Mobile</strong></td>
                                    <td>{{$customer_list->mobile}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Address</strong></td>
                                    <td>{{$customer_list->address}}</td>
                                </tr>
                                <tr>
                                    <td><strong>City</strong></td>
                                    <td>{{$customer_list->city}}</td>
                                </tr>
                                <tr>
                                    <td><strong>State</strong></td>
                                    <td>{{$customer_list->state}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Zip</strong></td>
                                    <td>{{$customer_list->zip}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Company</strong></td>
                                    <td>{{$customer_list->company}}</td>
                                </tr>
                                <tr>
                                    <td><strong>GST Number</strong></td>
                                    <td>{{$customer_list->gstin}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Created On</strong></td>
                                    <td>{{\Carbon\Carbon::parse($customer_list->created_at)->format('d-m-Y h:i:s')}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Updated On</strong></td>
                                    <td>{{\Carbon\Carbon::parse($customer_list->updated_at)->format('d-m-Y h:i:s')}}</td>
                                </tr>

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
