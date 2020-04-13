@extends("admin.layouts.main")

@section("content")

    <form-user></form-user>
    <admin-list api_to_fetch="{{route("users.index")}}" type="user">
        <template v-slot:collection="{ collection }">
            <user-item v-for="item in collection" v-bind:user="item"></user-item>
        </template>
    </admin-list>

@endsection
