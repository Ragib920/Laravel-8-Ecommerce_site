<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;

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
            $result['id']=$arr['0']->id;
        }
        else{
            $result['name']='';
            $result['slug']='';
            $result['id']=0;
        }
        return view('AdminPanel.manage_category',$result);
    }

    public function ManageCategoryProcess(Request $request)
    {
//        $request->validate([
//           'name'=>'required',
//            'slug'=>'required|unique:category',
//        ]);

        $rules=[
            'name'=>'required',
            'slug'=>'required|unique:category,slug,'.$request->post('id'),
        ];
        $custom_message=[
            'name.required'=>'Please enter Category Name',
            'slug.required'=>'Please enter Category slug',
            'slug.unique'=>'This category slug already exist',
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

        $model->name= $request->post('name');
        $model->slug= $request->post('slug');
        $model->save();
        return back()->with('message',$msg);
    }

    public function DeleteCategory($id)
    {
        CategoryModel::where('id',$id)->delete();
        return back()->with('message','Category Deleted Successfully');
    }


}
