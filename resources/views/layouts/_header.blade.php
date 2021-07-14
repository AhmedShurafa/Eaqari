<!-- Top Bar -->
<section id="top-bar" class="p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <i class="fas fa-phone"></i> (617)-555-5555
            </div>
            <div class="col-md-6 text-left">
                <i class="fas fa-envelope-open"></i> contact@btrealestate.co
            </div>
        </div>
    </div>
</section>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top" style="position:relative;">
    <div class="container">
        <a class="navbar-brand" href="{{route("main")}}">
            <img src="{{asset('assets/img/sdf.png')}}" class="logo" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <li class="nav-item mr-3 {{Request::is('/') ? 'active' : null }}">
                    <a class="nav-link" href="{{route("main")}}">الرئيسية</a>
                </li>
                <li class="nav-item mr-3 {{Request::is('about') ? 'active' : null }}">
                    <a class="nav-link" href="{{route('about')}}">من نحن</a>
                </li>
                <li class="nav-item mr-3 {{Request::is('houses') ? 'active' : null }}">
                    <a class="nav-link" href="{{route('house.all')}}">احدث المنشأت</a>
                </li>
            </ul>

            <ul class="navbar-nav account">
{{--                @guest('web')--}}
                @if(!Auth::guard('customer')->check() || Auth::guard('owner')->check())
                <li class="nav-item {{Request::is('login') ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            تسجيل الدخول
                        </a>
                    </li>
                    {{-- @if (Route::has('register')) --}}
                        <li class="nav-item {{Request::is('register') ? 'active' : null }}">
                            <a class="nav-link" href="{{ route('showregister') }}">
                                <i class="fas fa-user-plus"></i>
                                تسجيل مستخدم جديد</a>
                            </a>
                        </li>
                    {{-- @endif --}}
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{Auth::guard('customer')->user()->name}}
                            <i class="fas fa-user"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                <i class="fas fa-sign-out-alt"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logoutCustomer') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                @endif
            </ul>
        </div>
    </div>
</nav>
