<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{url('admin/dashboard')}}">
            <img src="{{asset('images/icon/logo.png')}}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class=" @yield('dashboard_select') ">
                    <a href="{{url('admin/dashboard')}}">
                        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                </li>
                <li class=" @yield('category_select') ">
                    <a href="{{url('admin/category')}}">
                        <i class="fas fa-list"></i>Category</a>
                </li>
                <li class=" @yield('coupon_select') ">
                    <a href="{{url('admin/coupon')}}">
                        <i class="fas fa-tags"></i>Coupon</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->
