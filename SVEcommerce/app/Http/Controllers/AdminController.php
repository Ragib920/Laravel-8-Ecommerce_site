<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function DashboardView()
    {
        return view('AdminPanel.dashboard');
    }

    public function LoginView(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin/dashboard');
        }
        else{

            return view('AdminPanel.login');
        }
    }

    public function LogIn(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

//        $result = AdminModel::where(['email'=>$email,'password'=>$password])->get();
        $result = AdminModel::where(['email'=>$email])->first();
        if($result){
            if (Hash::check($request->post('password'),$result->password)){
                $request->session()->put('ADMIN_LOGIN',true);
                $request->session()->put('ADMIN_ID',$result->id);
                return redirect('admin/dashboard');
            }
            else{
                $request->session()->flash('error','Please enter valid password');
                return redirect('admin/login');
            }

        }
        else{
            $request->session()->flash('error','Please enter valid login information');
            return redirect('admin/login');
        }

    }

    function onLogout(Request $request){
        $request->session()->flush();
        return redirect('admin/login');
    }

//    function updatepassword(){
//        $r=AdminModel::find(1);
//        $r->password=Hash::make('123456789');
//        $r->save();
//    }





}
