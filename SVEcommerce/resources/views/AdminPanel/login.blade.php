@extends('AuthLayouts.app')

@section('title','Admin Login')

@section('content')
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{asset('images/icon/logo.png')}}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{route('AdminPanel.login')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
                                </div>
{{--                                <div class="login-checkbox">--}}
{{--                                    <label>--}}
{{--                                        <input type="checkbox" name="remember">Remember Me--}}
{{--                                    </label>--}}
{{--                                    <label>--}}
{{--                                        <a href="#">Forgotten Password?</a>--}}
{{--                                    </label>--}}
{{--                                </div>--}}

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

                                @if(Session::has('error'))
                                    <div class="alert alert-danger text-center pt-3" role="alert">
                                        {{Session::get('error')}}
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
