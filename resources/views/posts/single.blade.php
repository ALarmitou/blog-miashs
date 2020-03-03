@extends("layouts/main")

@section("content")
    <div class="blog-post">
        <h3>{{$post->post_title}} <small>{{$post->post_date}}</small></h3>
        <img class="thumbnail" src="https://placehold.it/850x350">
        <p>{{$post->post_content}}</p>
        <div class="callout">
            <ul class="menu simple">
                <li><a href="#">Author: {{$post->author->name}}</a></li>
            </ul>
        </div>
    </div>
    <comment-list post_id="{{$post->id}}"></comment-list>
    <form-comment post_id="{{$post->id}}"></form-comment>

@endsection
