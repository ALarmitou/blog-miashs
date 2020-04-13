@extends("layouts/main")

@section("content")
    <div class="blog-post">
        <h3>{{$post->post_title}} <small>{{$post->post_date}}</small></h3>
        @if($post->author->id === auth()->user()->id)
            <form-post post="{{json_encode($post)}}"></form-post>
        @endif
        <img class="thumbnail" src="https://placehold.it/850x350">
        <p>{{$post->post_content}}</p>
        <div class="callout">
            <ul class="menu simple">
                <li><a href="#">Author: {{$post->author->name}}</a></li>
            </ul>
        </div>
    </div>
    @if($post->author->id === auth()->user()->id || auth()->user()->can("manage-comments"))
        <comment-list can_delete="true" post_id="{{$post->id}}"></comment-list>
    @else
        <comment-list post_id="{{$post->id}}"></comment-list>
    @endif
    <form-comment post_id="{{$post->id}}"></form-comment>

@endsection
