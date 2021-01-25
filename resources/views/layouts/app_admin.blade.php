<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@if(!empty($altDescription)){{$altDescription}}@else{{ __('messages.cool_medicines') }}@endif">
    <link rel="icon" href="{{ asset('/animated_favicon.gif')}}" type="image/gif" >
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(!empty($alt_title)){{$alt_title}} @else{{ __('messages.cool_medicines') }}@endif</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/53707af6ce.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        <header class="backgound-image w-100">
            <div class="container">
                <div class="d-flex p-2 align-items-center justify-content-between bd-highlight flex-wrap">
                    <a href="{{route('main.page')}}">
                        <img class="float-left" src="{{asset('/img/header_logo.png')}}" alt="Header logo" />
                    </a>
                    <div class="text-light font-weight-bold"><i class="fa fa-phone"></i><span class="mr-2"> Phone +3884642484</span></div>

                    <div id="divWithInputSearchInHeader" class="d-flex mr-2 form-group col-4 p-0 text-white border-0 my-color-for-search-in-header">
                        <input class="d-inline w-100 border-0 text-white my-class-color-transparent" type="text" placeholder="Search">
                        <button class="d-inline btn btn-search" type="submit" title="Search">
                            <i id="searchSignHeader" class="fa fa-search mb-2 text-white d-inline"></i>
                        </button>
                    </div>

                    <div class="p-0" id="divButtonCardShower">
                        <button class="btn btn-primary" id="btnButtonCardShower">
                            <i class="fa fa-shopping-cart d-inline"></i>
                            {{__('CART')}}
                        </button>
                        <span class="d-inline-block div-divButtonCardShower-right">
                            0
                        </span>
                    </div>

                </div>
            </div>
        <br>
            <div class="w-100 main-menu-div">
                <div class="container ">
                <nav class="navbar navbar-expand-md navbar-light shadow-sm">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link item-root" id="btn-show-parent-categories" href="#">
                                    {{ __('Products')}}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link item-menu-non-root" href="#">{{ __('Bestsellers')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link item-menu-non-root" href="#">{{ __('Resources')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link item-menu-non-root" href="#">{{ __('About Us')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link item-menu-non-root" href="#">{{ __('Blog')}}</a>
                            </li>
                        </ul>
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto"></ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin') }}">{{ __('Admin control') }}</a>
                                </li>
                            @endauth

                        <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Hello {{ Auth::user()->login }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>

                    </div>
                </nav>
                    @include('menu._root_categories')
                </div>

            </div>

        </header>
        <main class="py-4">
            @yield('content')
        </main>
        <footer>
            <section class="place-holder"></section>
            <div class="text-center">
                <p>Admin footer (TODO?)</p>
            </div>
        </footer>
    </div>
</body>
</html>
