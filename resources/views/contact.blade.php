@extends('layouts/main')

@section("content")


    <h1>Contact</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('message'))
        <div>
            {{ session('message')}}
        </div>
    @endif
    
    <form action="{{route("contact.store")}}" method="post">
        @csrf
        <div class="form-group">
            <label for="contact_name">Name</label>
            <input type="text" name="contact_name">
        </div>
        <div class="form-group">
            <label for="contact_email">Email</label>
            <input type="text" name="contact_email">
        </div>
        <div class="form-group">
            <label for="contact_message">Message</label>
            <textarea name="contact_message" id="" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
