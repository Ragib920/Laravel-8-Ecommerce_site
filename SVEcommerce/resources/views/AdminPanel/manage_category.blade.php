@extends('AdminLayouts.app')

@section('title','Categories')
@section('category_select','active')
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
                                <form action="{{route('category.ManageCategoryProcess')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input  name="id" value="{{$id}}" type="hidden"  >
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category Name</label>
                                                <input  name="name" value="{{$name}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category_name" class="control-label mb-1">Parent  Category</label>
                                                <select id="parent_category_id" name="parent_category_id" class="form-control" required>
                                                    <option value="0">Select Categories</option>
                                                    @foreach($category as $list)
                                                        @if($parent_category_id==$list->id)
                                                            <option selected value="{{$list->id}}">
                                                        @else
                                                            <option value="{{$list->id}}">
                                                                @endif
                                                                {{$list->name}}
                                                            </option>
                                                            @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category Slug</label>
                                                <input  name="slug" value="{{$slug}}" type="text" class="form-control" aria-required="true" aria-invalid="false" >
                                                @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image" class="control-label mb-1"> Image</label>
                                                <input id="category_image" name="category_image" type="file" class="form-control" aria-required="true" aria-invalid="false" {{$image_required}} >
                                                @error('category_image')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror


                                                @if($category_image!='')
                                                    <a href="{{asset('storage/media/category/'.$category_image)}}" target="_blank"><img width="100px" src="{{asset('storage/media/category/'.$category_image)}}"/></a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="control-label mb-1"> Show in Home Page</label>
                                        <input id="is_home" name="is_home" type="checkbox" {{$is_home_selected}}>
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
