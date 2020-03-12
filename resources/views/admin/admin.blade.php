@extends("admin/layouts/main")

@section("content")
    <ul>
@foreach($models as $model)
    <li><a href="/admin/{{strtolower($model)}}">{{$model}}</a></li>
@endforeach
    </ul>
@endsection
