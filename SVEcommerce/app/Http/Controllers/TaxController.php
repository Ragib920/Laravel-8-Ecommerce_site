<?php

namespace App\Http\Controllers;

use App\Models\TaxModel;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function TaxView()
    {
        $result = TaxModel::all();
        return view('AdminPanel.tax',compact('result'));
    }
    public function ManageTaxView(Request $request,$id='')
    {
        if ($id>0){
            $arr= TaxModel::where(['id'=>$id])->get();

            $result['tax_desc']=$arr['0']->tax_desc;
            $result['tax_value']=$arr['0']->tax_value;
            $result['status']=$arr['0']->status;
            $result['id']=$arr['0']->id;
        }
        else{
            $result['tax_desc']='';
            $result['tax_value']='';
            $result['status']='';
            $result['id']=0;
        }
        return view('AdminPanel.manage_tax',$result);
    }

    public function ManageTaxProcess(Request $request)
    {


        $rules=[
            'tax_value'=>'required|unique:taxes,tax_value,'.$request->post('id'),
        ];
        $custom_message=[
            'tax_value.unique'=>'This Tax value already exist',


        ];
        $this->validate($request, $rules, $custom_message);


        if ( $request->post('id')>0){

            $model = TaxModel::find($request->post('id'));
            $msg=" Tax Updated Successfully ";
        }
        else{
            $model = new TaxModel();
            $msg=" Tax Added Successfully ";
        }

        $model->tax_desc=$request->post('tax_desc');
        $model->tax_value=$request->post('tax_value');
        $model->status=1;
        $model->save();
        return back()->with('message',$msg);
    }

    public function DeleteTax($id)
    {
        TaxModel::where('id',$id)->delete();
        return back()->with('message','Tax Deleted Successfully');
    }

    public function status($status,$id )
    {
        $model = TaxModel::Find($id);
        $model->status=$status;
        $model->save();
        return back()->with('message','Tax Status updated Successfully');
    }
}
