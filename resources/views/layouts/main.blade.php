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
    <top-bar></top-bar>

    <div class="callout large primary">
        <div class="row column text-center">
            <h1>Our Blog</h1>
            <h2 class="subheader">Such a Simple Blog Layout</h2>
        </div>
    </div>

    <div class="row medium-8 large-7 columns">
       @yield("content")
    </div>
</div>
</body>
</html>
