@extends('layouts/main')

@section("content")
    <h1>Home</h1>
    <form-post></form-post>
    <ul>
        @foreach ( $posts as $post )

            <li><a href="/articles/{{$post->post_name}}">{{ $post->post_title }}</a></li>

        @endforeach
    </ul>
@endsection
