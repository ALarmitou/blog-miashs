@extends('layouts/main')

@section("content")
    <h1>Articles</h1>
    @auth()
        @if(auth()->user()->can("create-posts"))
            <form-post></form-post>
        @endif
    @endauth
    <post-list></post-list>
@endsection
