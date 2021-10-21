<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function DashboardView()
    {
        return view('AdminPanel.dashboard');
    }
    public function LoginView()
    {
        return view('AdminPanel.login');
    }
}
