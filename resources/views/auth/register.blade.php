@extends('layouts.main')

@section('content')
    <div class="row justify-content-center">
        <div class="columns">
            <register-form register_route="{{route("register")}}" redirect="/"></register-form>
        </div>
    </div>
@endsection
