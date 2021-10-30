@extends('AdminLayouts.app')

@section('title','Product')
@section('product_select','active')
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
                        <form action="{{route('product.ManageProductProcess')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">Product</div>
                                <div class="card-body">
                                    <input  name="id" value="{{$id}}" type="hidden" >

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Product Name</label>
                                        <input  name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Slug</label>
                                                <input  name="slug" value="{{$slug}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                                @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        @if($image!='')
                                                            <img width="100px" src="{{asset('storage/media/'.$image)}}"/>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                        <label for="cc-payment" class="control-label mb-1">Image</label>
                                                        <input  name="image" type="file" class="form-control" aria-required="true" aria-invalid="false"  {{$image_required}} >
                                                        @error('image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                                <div class="row form-group">

                                                    <div class="col-12 col-md-12">
                                                        <select name="category_id"  class="form-control" required="required" >
                                                            <option value=""> Select one</option>
                                                                @foreach($category_list as $data)
                                                                @if($category_id==$data->id)
                                                                    <option selected value="{{ $data->id }}"> {{ $data->name }}</option>
                                                                @else
                                                                    <option  value="{{ $data->id }}"> {{ $data->name }}</option>
                                                                @endif
                                                                @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Brand</label>
                                                <input  name="brand" value="{{$brand}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Model</label>
                                                <input  name="model" value="{{$model}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Short Description</label>
                                                <textarea name="short_desc"  rows="3" class="form-control" required >{{ $short_desc }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                                <textarea name="desc"  rows="3" class="form-control" required> {{$desc}} </textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Keywords</label>
                                                <textarea name="keywords"  rows="3" class="form-control" required >{{$keywords}} </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Technical Specification</label>
                                                <textarea name="technical_specification"  rows="3" class="form-control" required> {{$technical_specification}} </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Uses</label>
                                        <textarea name="uses"  rows="3" class="form-control" required>{{$uses}} </textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Warranty</label>
                                        <input  name="warranty" value="{{$warranty}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="overview-wrap">
                                       <p style="font-size: 18px; padding-bottom: 5px; "> Product Attributes </p>
                                    </div>
                                </div>
                            </div>

                            @if(session()->has('sku_error'))
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    {{session('sku_error')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-12" id="product_attr_box">
                                    @php
                                        $loop_count_num=1;
                                    @endphp
                                    @foreach($productAttrArr as $key=>$val)
                                        @php
                                            $loop_count_prev = $loop_count_num;
                                            $pAArr=(array)$val;
                                        @endphp
                                        <input id="paid" type="hidden" name="paid[]" value="{{$pAArr['id']}}">
                                        <div class="card"  id="product_attr_{{$loop_count_num++}}" >
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="cc-payment" class="control-label mb-1">SKU Code</label>
                                                            <input  name="sku[]" value="{{$pAArr['sku']}}" type="text" class="form-control" aria-required="true" aria-invalid="false"  >
                                                            @error('sku')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="cc-payment" class="control-label mb-1">MRP</label>
                                                            <input  name="mrp[]" value="{{$pAArr['mrp']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                                            <input  name="price[]" value="{{$pAArr['price']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="cc-payment" class="control-label mb-1">Color</label>
                                                            <select name="color_id[]" id="color_id"   class="form-control"  >
                                                                <option value="">Select</option>
                                                                @foreach($color_list as $data)
                                                                    @if($pAArr['color_id']==$data->id)
                                                                        <option selected value="{{ $data->id }}"> {{ $data->color }}</option>
                                                                    @else
                                                                        <option  value="{{ $data->id }}"> {{ $data->color }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="cc-payment" class="control-label mb-1">Size</label>
                                                            <select name="size_id[]" id="size_id" class="form-control" >
                                                                <option value="">Select</option>
                                                                @foreach($size_list as $data)
                                                                    @if($pAArr['size_id']==$data->id)
                                                                        <option selected value="{{ $data->id }}"> {{ $data->size }}</option>
                                                                    @else
                                                                        <option  value="{{ $data->id }}"> {{ $data->size }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    @if($pAArr['attr_image']!='')
                                                                        <img width="70px" src="{{asset('storage/media/'.$pAArr['attr_image'])}}"/>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                                                    <input  name="attr_image[]"  type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}} >
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="cc-payment" class="control-label mb-1">Quantity</label>
                                                            <input  name="quantity[]" value="{{$pAArr['quantity']}}" type="text" class="form-control" aria-required="true" aria-invalid="false" required >
                                                        </div>
                                                    </div>
                                                    @if($loop_count_num==2)

                                                        <div class="col-md-3" style="padding-top: 30px;">
                                                            <a class="btn btn-success text-light " onclick="add_more()" > <i class="fas fa-plus"></i> Add More </a>
                                                        </div>
                                                    @else
                                                        <div class="col-md-3" style="padding-top: 30px;">
                                                            <a href="{{url('admin/product/product_attr_delete/')}}/{{$pAArr['id']}}/{{$id}}"><button type="button" class="btn btn-danger">
                                                                <i class="fa fa-plus"></i>&nbsp; Remove</button></a>
                                                        </div>
                                                    @endif

{{--                                                    <div class="col-md-3" style="padding-top: 30px;">--}}
{{--                                                        <a class="btn btn-success text-light " onclick="add_more()" > <i class="fas fa-plus"></i> Add More </a>--}}
{{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div>
                                <button  type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var loop_count=1;

        function add_more(){
            loop_count++;
            var html = '<input id="paid" type="hidden" name="paid[]" > <div class="card" id="product_attr_{{$loop_count_num++}}"> <div class="card-header">Product Attribute</div> <div class="card-body"> <div class="row">';

            html+= '  <div class="col-md-4"> <div class="form-group"> <label for="cc-payment" class="control-label mb-1">SKU Code</label> <input  name="sku[]" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required ></div> </div> ';

            html+=' <div class="col-md-2"> <div class="form-group"> <label for="cc-payment" class="control-label mb-1">MRP</label> <input  name="mrp[]" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required ></div> </div>';

            html+='<div class="col-md-2"> <div class="form-group"> <label for="cc-payment" class="control-label mb-1">Price</label> <input  name="price[]" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required ></div> </div>';

            var color_id_html =jQuery('#color_id').html();
            color_id_html = color_id_html.replace("selected", "");
            html+=' <div class="col-md-2"> <div class="form-group"> <label for="color_id" class="control-label mb-1">Color</label> <select name="color_id[]"  class="form-control"> '+ color_id_html +' </select></div> </div> ';

            var size_id_html =jQuery('#size_id').html();
            size_id_html = size_id_html.replace("selected", "");
            html+=' <div class="col-md-2"><div class="form-group"> <label for="cc-payment" class="control-label mb-1">Size</label> <select name="size_id[]" id="size_id" class="form-control">'+ size_id_html +' </select></div> </div>  ';

            html+='  <div class="col-md-6"> <div class="form-group"> <label for="cc-payment" class="control-label mb-1">Image</label> <input  name="attr_image[]"  type="file" class="form-control" aria-required="true" aria-invalid="false" required ></div> </div> ';

            html+=' <div class="col-md-3"> <div class="form-group"> <label for="cc-payment" class="control-label mb-1">Quantity</label> <input  name="quantity[]" value="" type="text" class="form-control" aria-required="true" aria-invalid="false" required ></div> </div> ';

            html+=' <div class="col-md-3" style="padding-top: 30px;"> <a class="btn btn-danger text-light " onclick=remove_more("'+loop_count+'") > <i class="fas fa-minus-circle"></i> Remove </a> </div>  ';

            html+='</div></div></div>';

            jQuery('#product_attr_box').append(html)
        }

        function remove_more(loop_count){
            jQuery('#product_attr_'+loop_count).remove();
        }
    </script>

@endsection

@section('script')
    @if(Session::has('message'))
        <script>
            toastr.success("{!! Session::get('message') !!}");
        </script>
    @endif
@endsection