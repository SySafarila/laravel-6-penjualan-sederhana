<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Rafly Resto
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is(['products', 'products/*']) ? 'active' : '' }}"
                                    href="{{ route('products.public.index') }}">
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->role->name == 'seller')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is(['products', 'products/*']) ? 'active' : '' }}" href="{{ route('products.public.index') }}">
                                        Products
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is(['seller/products']) ? 'active' : '' }}" href="{{ route('products.index') }}">
                                        Products Manager
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is(['seller/invoices', 'seller/invoices/*']) ? 'active' : '' }}" href="{{ route('seller.invoices.index') }}">
                                        Invoices
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->role->name == 'buyer')
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is(['products', 'products/*']) ? 'active' : '' }}"
                                        href="{{ route('products.public.index') }}">
                                        Products
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is(['invoices', 'invoices/*']) ? 'active' : '' }}"
                                        href="{{ route('invoices.index') }}">
                                        Invoices
                                    </a>
                                </li>
                            @endif
                            @component('components.carts')
                            @endcomponent
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    {{-- @if (Auth::user()->role->name == 'seller')
                                        <a class="dropdown-item" href="{{ route('products.index') }}">
                                            Products
                                        </a>
                                        <a class="dropdown-item" href="{{ route('seller.invoices.index') }}">
                                            Invoices
                                        </a>
                                    @endif --}}
                                    {{-- @if (Auth::user()->role->name == 'buyer')
                                        <a class="dropdown-item" href="{{ route('invoices.index') }}">
                                            Invoices
                                        </a>
                                    @endif --}}
                                    <a class="dropdown-item" href="{{ route('account.index') }}">
                                        Account
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @yield('script')
</body>

</html>
