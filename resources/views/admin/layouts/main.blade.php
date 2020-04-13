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
<div id="app">
    @guest
        <top-bar></top-bar>
    @else
        <top-bar user="{{Auth::user()}}"></top-bar>
    @endguest
    <div class="callout large alert">
        <div class="row column text-center">
            <h1>Admin page</h1>
            <h2 class="subheader">something something</h2>
        </div>
    </div>

<div class="row medium-8 large-7 columns">
   @yield("content")
</div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
<script>
    $(document).foundation();
</script>
</body>
</html>
