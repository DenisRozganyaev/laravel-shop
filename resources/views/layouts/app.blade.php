<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ h_secure_asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ h_secure_asset('css/iziToast.css') }}" rel="stylesheet">
    <link href="{{ h_secure_asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ h_secure_asset('js/iziToast.js') }}" defer></script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ h_secure_url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">{{ __('Products') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        @include('navigation.parts.language_switcher')
                    </li>
                    <li class="nav-item"><a href="#" class="nav-link disabled">|</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}">
                            {{ __('Cart') }} @if(Cart::instance('cart')->count() > 0) -
                            <strong>{{ Cart::instance('cart')->count() }}</strong> @endif
                        </a>
                    </li>
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('account.main') }}">
                                {{ __('Account') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
{{--                        <li class="nav-item dropdown">--}}
{{--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
{{--                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                {{ Auth::user()->name }}--}}
{{--                            </a>--}}

{{--                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">--}}
{{--                                @if (is_admin(Auth::user()))--}}
{{--                                    <a class="dropdown-item" href="{{ route('admin.home') }}">--}}
{{--                                        {{ __('Admin Dashboard') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                <a class="dropdown-item" href="{{ route('account.main') }}">--}}
{{--                                    {{ __('Account') }}--}}
{{--                                </a>--}}
{{--                                <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                                   onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                    {{ __('Logout') }}--}}
{{--                                </a>--}}

{{--                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                    @csrf--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </li>--}}
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @if(Auth::check() && is_admin(Auth::user()) && (Request::is('admin/*') || Request::is('admin')))
        @include('navigation.admin-menu')
    @endif

    <main class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('warn'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('warn') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @yield('content')
    </main>
</div>
@stack('scripts')
</body>
</html>
