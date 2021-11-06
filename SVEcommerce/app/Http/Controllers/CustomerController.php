<?php

namespace App\Http\Controllers;

use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function CustomerView()
    {
        $result = CustomerModel::all();
        return view('AdminPanel.customer',compact('result'));
    }

    public function show(Request $request,$id='')
    {
        $arr=CustomerModel::where(['id'=>$id])->get();
        $result['customer_list']=$arr['0'];
        return view('AdminPanel.customer_details',$result);
    }


    public function status($status,$id )
    {
        $model = CustomerModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message','Customer Status updated Successfully');
    }
}
