<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Foundation | Welcome</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="top-bar">
    <div class="top-bar-left">
        <ul class="menu">
            <li class="menu-text">Blog</li>
            <li><a href="/">Home</a></li>
            <li><a href="/articles">Articles</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="menu dropdown" data-dropdown-menu>
            <!-- Authentication Links -->
            @guest
                <li>
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li>
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li>
                    {{ Auth::user()->name }}
                    <ul class="menu vertical">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
</div>


<div class="callout large alert">
    <div class="row column text-center">
        <h1>Admin page</h1>
        <h2 class="subheader">something something</h2>
    </div>
</div>

<div id="app" class="row medium-8 large-7 columns">
   @yield("content")
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>
