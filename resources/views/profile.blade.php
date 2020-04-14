@extends('layouts/main')

@section("content")
    <profile user="{{auth()->user()}}" roles="{{auth()->user()->roles}}" posts="{{auth()->user()->posts}}"></profile>
@endsection
