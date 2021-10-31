<?php

namespace App\Http\Controllers;

use App\Models\CouponModel;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function CouponView()
    {
        $result = CouponModel::all();
        return view('AdminPanel.coupon',compact('result'));
    }
    public function ManageCouponView(Request $request,$id='')
    {
        if ($id>0){
            $arr= CouponModel::where(['id'=>$id])->get();

            $result['title']=$arr['0']->title;
            $result['code']=$arr['0']->code;
            $result['value']=$arr['0']->value;
            $result['type']=$arr['0']->type;
            $result['min_order_amt']=$arr['0']->min_order_amt;
            $result['is_one_time']=$arr['0']->is_one_time;
            $result['id']=$arr['0']->id;
        }
        else{
            $result['title']='';
            $result['code']='';
            $result['value']='';
            $result['type']='';
            $result['min_order_amt']='';
            $result['is_one_time']='';
            $result['id']=0;
        }
        return view('AdminPanel.manage_coupon',$result);
    }

    public function ManageCouponProcess(Request $request)
    {
//        $request->validate([
//           'name'=>'required',
//            'slug'=>'required|unique:category',
//        ]);

        $rules=[
            'title'=>'required',
            'code'=>'required|unique:coupon,code,'.$request->post('id'),
            'value'=>'required',
        ];
        $custom_message=[
            'title.required'=>'Please enter Coupon Title',
            'code.required'=>'Please enter Coupon code',
            'code.unique'=>'This Coupon code already exist',
            'value.required'=>'Please enter Coupon value',
        ];
        $this->validate($request, $rules, $custom_message);


        if ( $request->post('id')>0){

            $model = CouponModel::find($request->post('id'));
            $msg=" Coupon Updated Successfully ";
        }
        else{
            $model = new CouponModel();
            $msg=" Coupon Added Successfully ";
        }

        $model->title= $request->post('title');
        $model->code= $request->post('code');
        $model->value= $request->post('value');
        $model->type=$request->post('type');
        $model->min_order_amt=$request->post('min_order_amt');
        $model->is_one_time=$request->post('is_one_time');
        $model->status=1;
        $model->save();
        return back()->with('message',$msg);
    }

    public function DeleteCoupon($id)
    {
        CouponModel::where('id',$id)->delete();
        return back()->with('message','Coupon Deleted Successfully');
    }

    public function status($status,$id )
    {
        $model = CouponModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message','Coupon Status updated Successfully');
    }
}
