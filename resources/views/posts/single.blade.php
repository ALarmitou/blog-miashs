@extends("layouts/main")

@section("content")
    <div class="blog-post">
        <h3>{{$post->post_title}} <small>{{$post->post_date}}</small></h3>
        @auth()
        @if($post->author->id === auth()->user()->id)
            <form-post post_id="{{$post->id}}"></form-post>
        @endif
        @endauth
        <carousel :autoplay="true" :navigation-enabled="true">
        @foreach($post->files as $file)
            <slide>
                <img src="{{asset('storage/'.$file->post_name)}}"/>
            </slide>
        @endforeach
        </carousel>
        <p>{{$post->post_content}}</p>
        <div class="callout">
            <ul class="menu simple">
                <li><a href="#">Author: {{$post->author->name}}</a></li>
            </ul>
        </div>
    </div>
    @auth()
    @if($post->author->id === auth()->user()->id || auth()->user()->can("manage-comments"))
        <comment-list can_delete="true" post_id="{{$post->id}}"></comment-list>
    @endif
    @else
        <comment-list post_id="{{$post->id}}"></comment-list>
    @endauth
    <form-comment post_id="{{$post->id}}"></form-comment>

@endsection
