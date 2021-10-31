@extends('AdminLayouts.app')

@section('title','Tax')
@section('tax_select','active')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('tax.ManageTaxProcess')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="size" class="control-label mb-1">Tax Value </label>
                                        <input id="tax_value" value="{{$tax_value}}" name="tax_value" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                        @error('tax_value')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="form-group">
                                        <label for="size" class="control-label mb-1">Tax Desc </label>
                                        <input id="tax_desc" value="{{$tax_desc}}" name="tax_desc" type="text" class="form-control" aria-required="true" aria-invalid="false" required>
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            Submit
                                        </button>
                                    </div>
                                    <input type="hidden" name="id" value="{{$id}}"/>
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
