@extends("admin.layouts.main")

@section("content")

    <form-post></form-post>
    <admin-list api_to_fetch="{{route("api.posts.index")}}" type="post">
        <template v-slot:collection="{ collection }">
            <post-item v-for="item in collection" :post="item" img-path="{{asset("storage/")}}"></post-item>
        </template>
    </admin-list>

@endsection
