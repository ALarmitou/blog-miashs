@extends('layouts/main')

@section("content")
    <profile user="{{auth()->user()}}" roles="{{auth()->user()->roles}}" permissions="{{auth()->user()->permissions}}" posts="{{auth()->user()->posts}}"></profile>
@endsection
