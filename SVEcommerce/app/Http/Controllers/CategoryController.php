<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function CategoryView()
    {
        $result = CategoryModel::all();
        return view('AdminPanel.category',compact('result'));
    }
    public function ManageCategoryView(Request $request,$id='')
    {
        if ($id>0){
            $arr= CategoryModel::where(['id'=>$id])->get();

            $result['name']=$arr['0']->name;
            $result['slug']=$arr['0']->slug;
            $result['parent_category_id']=$arr['0']->parent_category_id;
            $result['category_image']=$arr['0']->category_image;
            $result['is_home']=$arr['0']->is_home;
            $result['is_home_selected']="";
            if($arr['0']->is_home==1){
                $result['is_home_selected']="checked";
            }
            $result['id']=$arr['0']->id;

            $result['category']=DB::table('category')->where(['status'=>1])->where('id','!=',$id)->get();
        }
        else{
            $result['name']='';
            $result['slug']='';
            $result['parent_category_id']='';
            $result['category_image']='';
            $result['is_home']="";
            $result['is_home_selected']="";
            $result['id']=0;

            $result['category']=DB::table('category')->where(['status'=>1])->get();
        }
        return view('AdminPanel.manage_category',$result);
    }

    public function ManageCategoryProcess(Request $request)
    {
        //for category image validation
        if ( $request->post('id')>0) {

            $image_validation = "mimes:jpeg,png,jpg,gif|max:2048";
        }
        else{
            $image_validation = "mimes:jpeg,png,jpg,gif|max:2048";
        }

        $rules=[
            'name'=>'required',
            'category_image'=>$image_validation,
            'slug'=>'required|unique:category,slug,'.$request->post('id'),
        ];
        $custom_message=[
            'name.required'=>'Please enter Category Name',
            'slug.required'=>'Please enter Category slug',
            'slug.unique'=>'This category slug already exist',
            'category_image.mimes'=>'Image must be on jpeg,png,jpg,gif format',
        ];
        $this->validate($request, $rules, $custom_message);


        if ( $request->post('id')>0){

            $model = CategoryModel::find($request->post('id'));
            $msg=" Category Updated Successfully ";
        }
        else{
            $model = new CategoryModel();
            $msg=" Category Added Successfully ";
        }

        if($request->hasfile('category_image')){

            if($request->post('id')>0){
                $arrImage=DB::table('category')->where(['id'=>$request->post('id')])->get();
                if(Storage::exists('/public/media/category/'.$arrImage[0]->category_image)){
                    Storage::delete('/public/media/category/'.$arrImage[0]->category_image);
                }
            }

            $image=$request->file('category_image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/category',$image_name);
            $model->category_image=$image_name;
        }

        $model->name= $request->post('name');
        $model->slug= $request->post('slug');
        $model->parent_category_id=$request->post('parent_category_id');
        $model->is_home=0;
        if($request->post('is_home')!==null){
            $model->is_home=1;
        }
        $model->status=1;
        $model->save();
        return back()->with('message',$msg);
    }

    public function DeleteCategory($id)
    {
        $arrImage=DB::table('category')->where(['id'=>$id])->get();
        if(Storage::exists('/public/media/category/'.$arrImage[0]->category_image)){
            Storage::delete('/public/media/category/'.$arrImage[0]->category_image);
        }
        CategoryModel::where('id',$id)->delete();
        return back()->with('message','Category Deleted Successfully');
    }

    public function status($status,$id )
    {
        $model = CategoryModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message',' Category status updated Successfully');
    }


}
