@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="columns">
            <login-form login_route="{{route("login")}}" redirect="{{route("home")}}"></login-form>
        </div>
    </div>
@endsection
