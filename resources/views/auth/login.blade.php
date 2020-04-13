@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="columns">
            <login-form login_route="{{route("login")}}" redirect="/"></login-form>
        </div>
    </div>
@endsection
