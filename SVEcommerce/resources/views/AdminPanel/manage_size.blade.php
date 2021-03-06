@extends('AdminLayouts.app')

@section('title','Size')
@section('size_select','active')
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
                            <form action="{{route('size.ManageSizeProcess')}}" method="post">
                                @csrf
                                <input  name="id" value="{{$id}}" type="hidden" >
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Size</label>
                                    <input  name="size" value="{{$size}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                    @error('size')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
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
