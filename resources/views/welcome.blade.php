@extends('layouts/main')

@section("content")
    <h1>Home</h1>
    @auth()
    @if(auth()->user()->can("create-posts"))
    <form-post></form-post>
    @endif
    @endauth
    <ul>
        @foreach ( $posts as $post )

            <li><a href="/articles/{{$post->post_name}}">{{ $post->post_title }}</a></li>

        @endforeach
    </ul>
@endsection
