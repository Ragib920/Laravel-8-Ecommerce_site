<?php

namespace App\Http\Controllers;

use App\Models\SizeModel;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function SizeView()
    {
        $result = SizeModel::all();
        return view('AdminPanel.size',compact('result'));
    }
    public function ManageSizeView(Request $request,$id='')
    {
        if ($id>0){
            $arr= SizeModel::where(['id'=>$id])->get();

            $result['size']=$arr['0']->size;
            $result['id']=$arr['0']->id;
        }
        else{
            $result['size']='';
            $result['id']=0;
        }
        return view('AdminPanel.manage_size',$result);
    }

    public function ManageSizeProcess(Request $request)
    {
//        $request->validate([
//           'name'=>'required',
//            'slug'=>'required|unique:category',
//        ]);

        $rules=[
            'size'=>'required|unique:size,size,'.$request->post('id'),
        ];
        $custom_message=[
            'size.required'=>'Please enter size code',
            'size.unique'=>'This size code already exist',
        ];
        $this->validate($request, $rules, $custom_message);


        if ( $request->post('id')>0){

            $model = SizeModel::find($request->post('id'));
            $msg=" Size Updated Successfully ";
        }
        else{
            $model = new SizeModel();
            $msg=" Size Added Successfully ";
        }

        $model->size= $request->post('size');
        $model->status=1;
        $model->save();
        return back()->with('message',$msg);
    }

    public function DeleteSize($id)
    {
        SizeModel::where('id',$id)->delete();
        return back()->with('message','Size Deleted Successfully');
    }

    public function status($status,$id )
    {
        $model = SizeModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message','Size Status updated Successfully');
    }
}
