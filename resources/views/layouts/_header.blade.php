<!-- Top Bar -->
<section id="top-bar" class="p-3">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <i class="fas fa-phone"></i> (617)-555-5555
            </div>
            <div class="col-md-4">
                <i class="fas fa-envelope-open"></i> contact@btrealestate.co
            </div>
            <div class="col-md-4">
                <div class="social">
                    <a href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{route("main")}}">
            <img src="{{asset('assets/img/logo.png')}}" class="logo" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <li class="nav-item active mr-3">
                    <a class="nav-link" href="welcome.blade.php">الرئيسية</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link" href="about.html">ماذا عنا</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link" href="{{route('house.all')}}">احدث المنشأت</a>
                </li>
            </ul>

            <ul class="navbar-nav account">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            تسجيل الدخول
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="fas fa-user-plus"></i>
                                تسجيل مستخدم جديد</a>
                            </a>
                        </li>
                    @endif
                @else

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                            <i class="fas fa-user"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                                <i class="fas fa-sign-out-alt"></i>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
