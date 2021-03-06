<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ColorModel;
use App\Models\ProductAtrModel;
use App\Models\ProductModel;
use App\Models\SizeModel;
use App\Models\TaxModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function ProductView()
    {
        $result = ProductModel::all();
        return view('AdminPanel.product',compact('result'));
    }

    public function ManageProductView(Request $request,$id='')
    {
        if ($id>0){
            $arr= ProductModel::where(['id'=>$id])->get();

            $result['category_id']=$arr['0']->category_id;
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['slug']=$arr['0']->slug;
            $result['brand']=$arr['0']->brand;
            $result['model']=$arr['0']->model;
            $result['short_desc']=$arr['0']->short_desc;
            $result['desc']=$arr['0']->desc;
            $result['keywords']=$arr['0']->keywords;
            $result['technical_specification']=$arr['0']->technical_specification;
            $result['uses']=$arr['0']->uses;
            $result['warranty']=$arr['0']->warranty;
            $result['lead_time']=$arr['0']->lead_time;
            $result['tax_id']=$arr['0']->tax_id;
            $result['is_promo']=$arr['0']->is_promo;
            $result['is_featured']=$arr['0']->is_featured;
            $result['is_discounted']=$arr['0']->is_discounted;
            $result['is_tranding']=$arr['0']->is_tranding;
            $result['id']=$arr['0']->id;

            $result['productAttrArr']=DB::table('productAtr')->where(['product_id'=>$id])->get();
            //product image
            $productImagesArr=DB::table('productImage')->where(['product_id'=>$id])->get();
            if(!isset($productImagesArr[0])){
                $result['productImagesArr']['0']['id']='';
                $result['productImagesArr']['0']['images']='';
            }else{
                $result['productImagesArr']=$productImagesArr;
            }

        }
        else{
            $result['category_id']='';
            $result['name']='';
            $result['image']='';
            $result['slug']='';
            $result['brand']='';
            $result['model']='';
            $result['short_desc']='';
            $result['desc']='';
            $result['keywords']='';
            $result['technical_specification']='';
            $result['uses']='';
            $result['warranty']='';
            $result['lead_time']='';
            $result['tax_id']='';
            $result['is_promo']='';
            $result['is_featured']='';
            $result['is_discounted']='';
            $result['is_tranding']='';
            $result['id']=0;

            //Product Attribute
            $result['productAttrArr'][0]['id']='';
            $result['productAttrArr'][0]['product_id']='';
            $result['productAttrArr'][0]['sku']='';
            $result['productAttrArr'][0]['attr_image']='';
            $result['productAttrArr'][0]['mrp']='';
            $result['productAttrArr'][0]['price']='';
            $result['productAttrArr'][0]['quantity']='';
            $result['productAttrArr'][0]['size_id']='';
            $result['productAttrArr'][0]['color_id']='';
            //product image
            $result['productImagesArr']['0']['id']='';
            $result['productImagesArr']['0']['images']='';
        }


        $category_list= CategoryModel::where(['status'=>1])->get();
        $color_list= ColorModel::where(['status'=>1])->get();
        $size_list= SizeModel::where(['status'=>1])->get();
        $brand_list= BrandModel::where(['status'=>1])->get();
        $tax_list= TaxModel::where(['status'=>1])->get();

        return view('AdminPanel.manage_product',$result,compact('category_list','color_list','size_list','brand_list','tax_list'));
    }

    public function ManageProductProcess(Request $request)
    {

        //for product image validation
        if ( $request->post('id')>0) {

            $image_validation = "mimes:jpeg,png,jpg,gif|max:2048";
        }
        else{
            $image_validation = "required|mimes:jpeg,png,jpg,gif|max:2048";
        }


        $rules=[
            'image'=> $image_validation,
            'slug'=>'unique:product,slug,'.$request->post('id'),
            //for attribute images
            'attr_image.*' =>'mimes:jpg,jpeg,png',
            'images.*' =>'mimes:jpg,jpeg,png'
        ];
        $custom_message=[
            'image.required'=>'Please enter Image',
            'image.mimes'=>'Image must be on jpeg,png,jpg,gif format',
            'image.max'=>'Image size must be less than 2048',
            'slug.unique'=>'This category slug already exist',

            'attr_image.mimes'=>'Image must be on jpeg,png,jpg,gif format',
            'attr_image.max'=>'Image size must be less than 2048'

        ];
        $this->validate($request, $rules, $custom_message);

        // Product Attribute
        $paidArr=$request->post('paid');
        $skuArr=$request->post('sku');
        $mrpArr=$request->post('mrp');
        $priceArr=$request->post('price');
        $quantityArr=$request->post('quantity');
        $size_idArr=$request->post('size_id');
        $color_idArr=$request->post('color_id');

        //sku validation
        foreach($skuArr as $key=>$val){
            $check=DB::table('productAtr')->
            where('sku','=',$skuArr[$key])->
            where('id','!=',$paidArr[$key])->
            get();

            if(isset($check[0])){
                $request->session()->flash('sku_error',$skuArr[$key].' SKU already used');
                return redirect(request()->headers->get('referer'));
            }
        }

    // for insert update for product
        if ( $request->post('id')>0){

            $model = ProductModel::find($request->post('id'));
            $msg=" Product Updated Successfully ";
        }
        else{
            $model = new ProductModel();
            $msg=" Product Added Successfully ";
        }
        //For product  image
        if ($request->file('image')) {

            if($request->post('id')>0){
                $arrImage=DB::table('product')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/'.$arrImage[0]->image);
                }
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image=$image_name;
        }

        $model->category_id= $request->post('category_id');
        $model->name= $request->post('name');
        $model->slug= $request->post('slug');
        $model->brand= $request->post('brand');
        $model->model= $request->post('model');
        $model->short_desc= $request->post('short_desc');
        $model->desc= $request->post('desc');
        $model->keywords= $request->post('keywords');
        $model->technical_specification= $request->post('technical_specification');
        $model->uses= $request->post('uses');
        $model->warranty= $request->post('warranty');
        $model->lead_time=$request->post('lead_time');
        $model->tax_id=$request->post('tax_id');
        $model->is_promo=$request->post('is_promo');
        $model->is_featured=$request->post('is_featured');
        $model->is_discounted=$request->post('is_discounted');
        $model->is_tranding=$request->post('is_tranding');
        $model->status=1;
        $model->save();
        $pid=$model->id;

        //========Product Attribute starts=======

        foreach($skuArr as $key=>$val){
            $productAttrArr=[];
            $productAttrArr['product_id']=$pid;
            $productAttrArr['sku']=$skuArr[$key];
            $productAttrArr['mrp']=(int)$mrpArr[$key];
            $productAttrArr['price']=(int)$priceArr[$key];
            $productAttrArr['quantity']=(int)$quantityArr[$key];
            //for empty size id
            if($size_idArr[$key]==''){
                $productAttrArr['size_id']=0;
            }else{
                $productAttrArr['size_id']=$size_idArr[$key];
            }
            //for empty color id
            if($color_idArr[$key]==''){
                $productAttrArr['color_id']=0;
            }else{
                $productAttrArr['color_id']=$color_idArr[$key];
            }
            //FOR attribute images
            if($request->hasFile("attr_image.$key")){

                if($paidArr[$key]!=''){
                    $arrImage=DB::table('productAtr')->where(['id'=>$paidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)){
                        Storage::delete('/public/media/'.$arrImage[0]->attr_image);
                    }
                }

                $rand=rand('111111111','999999999');
                $attr_image=$request->file("attr_image.$key");
                $ext=$attr_image->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("attr_image.$key")->storeAs('/public/media',$image_name);
                $productAttrArr['attr_image']=$image_name;
            }
            // insert update for product attributes
            if($paidArr[$key]!=''){
                DB::table('productAtr')->where(['id'=>$paidArr[$key]])->update($productAttrArr);
            }else{
                DB::table('productAtr')->insert($productAttrArr);
            }

        }
        //========Product Attribute end=======

        /*Product Images Start*/
        $piidArr=$request->post('piid');
        foreach($piidArr as $key=>$val){
            $productImageArr=[];
            $productImageArr['product_id']=$pid;
            if($request->hasFile("images.$key")){

                if($piidArr[$key]!=''){
                    $arrImage=DB::table('productImage')->where(['id'=>$piidArr[$key]])->get();
                    if(Storage::exists('/public/media/'.$arrImage[0]->images)){
                        Storage::delete('/public/media/'.$arrImage[0]->images);
                    }
                }

                $rand=rand('111111111','999999999');
                $images=$request->file("images.$key");
                $ext=$images->extension();
                $image_name=$rand.'.'.$ext;
                $request->file("images.$key")->storeAs('/public/media',$image_name);
                $productImageArr['images']=$image_name;
            }

            if($piidArr[$key]!=''){
                DB::table('productImage')->where(['id'=>$piidArr[$key]])->update($productImageArr);
            }else{
                DB::table('productImage')->insert($productImageArr);
            }
        }
        /*Product Images End*/

        return redirect('admin/product')->with('message',$msg);
    }

    public function DeleteProduct($id)
    {


        //Product info and image starts
        $arrImage=DB::table('product')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->image)){
            Storage::delete('/public/media/'.$arrImage[0]->image);
        }
        //Product table and image ends

        //Product Attributes table starts
//        $pa=DB::table('productAtr')->where(['product_id'=>$id])->get();
//
//        if(Storage::exists('/public/media/'.$pa[0]->attr_image)){
//            Storage::delete('/public/media/'.$pa[0]->attr_image);
//        }

        //Product Attributes table ends

        //product images table starts
//        $pi=DB::table('productImage')->where(['product_id'=>$id])->get();

//            $Image=DB::table('productImage')->where(['product_id'=>$id])->get();
//            if(Storage::exists('/public/media/'.$pi[0]->images)){
//                Storage::delete('/public/media/'.$pi[0]->images);
//            }

        //product images table ends
        DB::table('product')->where(['id'=>$id])->delete();
        DB::table('productAtr')->where(['product_id'=>$id])->delete();
        DB::table('productImage')->where(['product_id'=>$id])->delete();
        return back()->with('message','Product Deleted Successfully');
    }

    public function product_attr_delete(Request $request,$paid,$pid){
        $arrImage=DB::table('productAtr')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->attr_image)){
            Storage::delete('/public/media/'.$arrImage[0]->attr_image);
        }
        DB::table('productAtr')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid)->with('message','Attribute Deleted Successfully');

    }

    public function product_images_delete(Request $request,$paid,$pid){
        $arrImage=DB::table('productImage')->where(['id'=>$paid])->get();
        if(Storage::exists('/public/media/'.$arrImage[0]->images)){
            Storage::delete('/public/media/'.$arrImage[0]->images);
        }
        DB::table('productImage')->where(['id'=>$paid])->delete();
        return redirect('admin/product/manage_product/'.$pid)->with('message','Product Image Delete Successfully');
    }

    public function status($status,$id )
    {
        $model = ProductModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message','Product Status updated Successfully');
    }


}
