@extends('AdminLayouts.app')

@section('title','Coupons')
@section('coupon_select','active')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header"> </div>
                        <div class="card-body">
                            <form action="{{route('coupon.ManageCouponProcess')}}" method="post">
                                @csrf
                                <input  name="id" value="{{$id}}" type="hidden" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Coupon Title</label>
                                            <input  name="title" value="{{$title}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Coupon Code</label>
                                            <input  name="code" value="{{$code}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Coupon Value</label>
                                            <input  name="value" value="{{$value}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                            @error('value')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="value" class="control-label mb-1">Type</label>
                                        <select id="type" name="type" class="form-control" required>
                                            @if($type=='value')
                                                <option value="value" selected>Value</option>
                                                <option value="per">Percentage</option>
                                            @elseif($type=='per')
                                                <option value="value">Value</option>
                                                <option value="Per" selected>Percentage</option>
                                            @else
                                                <option value="value">Value</option>
                                                <option value="per">Percentage</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="title" class="control-label mb-1">Min Order Amt</label>
                                        <input id="min_order_amt" value="{{$min_order_amt}}" name="min_order_amt" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="code" class="control-label mb-1">IS One Time</label>
                                        <select id="is_one_time" name="is_one_time" class="form-control" required>
                                            @if($is_one_time=='1')
                                                <option value="1" selected>Yes</option>
                                                <option value="0">No</option>
                                            @else
                                                <option value="1">Yes</option>
                                                <option value="0" selected>No</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <button  type="submit" class="btn btn-lg btn-info btn-block">
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    @if(Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>
    @endif
@endsection
