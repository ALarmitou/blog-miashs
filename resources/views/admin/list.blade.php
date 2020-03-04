@extends("admin/layouts/main")

@section("content")
    <admin-list api_to_fetch="{{route("api.".$type.".index")}}" type="{{substr($type, 0, -1)}}"></admin-list>
@endsection
