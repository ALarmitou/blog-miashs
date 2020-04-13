@extends("admin.layouts.main")

@section("content")

    <form-role></form-role>
    <admin-list api_to_fetch="{{route("roles.index")}}" type="role">
        <template v-slot:collection="{ collection }">
            <role-item v-for="item in collection" v-bind:role="item"></role-item>
        </template>
    </admin-list>

@endsection
