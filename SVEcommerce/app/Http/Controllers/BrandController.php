<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function BrandView()
    {
        $result = BrandModel::all();
        return view('AdminPanel.brand',compact('result'));
    }
    public function ManageBrandView(Request $request,$id='')
    {
        if ($id>0){
            $arr= BrandModel::where(['id'=>$id])->get();
            $result['name']=$arr['0']->name;
            $result['image']=$arr['0']->image;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }
        else{
            $result['name']='';
            $result['image']='';
            $result['status']='';
            $result['id']=0;
        }
        return view('AdminPanel.manage_brand',$result);
    }

    public function ManageBrandProcess(Request $request)
    {
        if ( $request->post('id')>0) {

            $image_validation = "required|mimes:jpeg,png,jpg,gif|max:2048";
        }
        else{
            $image_validation = "mimes:jpeg,png,jpg,gif|max:2048";
        }

        $rules=[
            'name'=>'unique:brands,name,'.$request->post('id'),
            'image'=>$image_validation,
        ];
        $custom_message=[
            'name.unique'=>'This Brand code already exist',
            'image.mimes'=>'Image must be on jpeg,png,jpg,gif format',
            'image.required'=>'Enter a image',

        ];
        $this->validate($request, $rules, $custom_message);


        if ( $request->post('id')>0){

            $model = BrandModel::find($request->post('id'));
            $msg=" Brand Updated Successfully ";
        }
        else{
            $model = new BrandModel();
            $msg=" Brand Added Successfully ";
        }

        if($request->hasfile('image')){

            if($request->post('id')>0){
                $arrImage= DB::table('brands')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/brand/'.$arrImage[0]->image)){
                    Storage::delete('/public/media/brand/'.$arrImage[0]->image);
                }
            }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/brand',$image_name);
            $model->image=$image_name;
        }

        $model->name= $request->post('name');
        $model->status=1;
        $model->save();
        return back()->with('message',$msg);
    }

    public function DeleteBrand(Request $request ,$id)
    {
        // $arrImage= DB::table('brands')->where(['id'=>$request->post('id')])->get();
        $arrImage=DB::table('brands')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/brand/'.$arrImage[0]->image)){
            Storage::delete('/public/media/brand/'.$arrImage[0]->image);
        }
        BrandModel::where('id',$id)->delete();
        return back()->with('message','Brand Deleted Successfully');
    }

    public function status($status,$id )
    {
        $model = BrandModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message','Brand Status updated Successfully');
    }
}
