@extends('AdminLayouts.app')

@section('title','Brand')
@section('brand_select','active')
@section('content')
    @if($id>0)
        {{$image_required=" "}}
    @else
        {{$image_required="required"}}
    @endif
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"> </div>
                            <div class="card-body">
                                <form action="{{route('brand.ManageBrandProcess')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input  name="id" value="{{$id}}" type="hidden" >
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Name</label>
                                        <input  name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="control-label mb-1"> Image</label>
                                        <input id="image" name="image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}}>


                                        @if($image!='')
                                            <img width="100px" src="{{asset('storage/media/brand/'.$image)}}"/>
                                        @endif

                                        @error('image')
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
