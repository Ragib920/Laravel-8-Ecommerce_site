<?php

namespace App\Http\Controllers;

use App\Models\ColorModel;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function ColorView()
    {
        $result = ColorModel::all();
        return view('AdminPanel.color',compact('result'));
    }
    public function ManageColorView(Request $request,$id='')
    {
        if ($id>0){
            $arr= ColorModel::where(['id'=>$id])->get();

            $result['color']=$arr['0']->color;
            $result['id']=$arr['0']->id;
        }
        else{
            $result['color']='';
            $result['id']=0;
        }
        return view('AdminPanel.manage_color',$result);
    }

    public function ManageColorProcess(Request $request)
    {
//        $request->validate([
//           'name'=>'required',
//            'slug'=>'required|unique:category',
//        ]);

        $rules=[
            'color'=>'required|unique:color,color,'.$request->post('id'),
        ];
        $custom_message=[
            'color.required'=>'Please enter color code',
            'color.unique'=>'This color code already exist',
        ];
        $this->validate($request, $rules, $custom_message);


        if ( $request->post('id')>0){

            $model = ColorModel::find($request->post('id'));
            $msg=" Color Updated Successfully ";
        }
        else{
            $model = new ColorModel();
            $msg=" Color Added Successfully ";
        }

        $model->color= $request->post('color');
        $model->status=1;
        $model->save();
        return back()->with('message',$msg);
    }

    public function DeleteColor($id)
    {
        ColorModel::where('id',$id)->delete();
        return back()->with('message','Color Deleted Successfully');
    }

    public function status($status,$id )
    {
        $model = ColorModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message','Color Status updated Successfully');
    }
}
