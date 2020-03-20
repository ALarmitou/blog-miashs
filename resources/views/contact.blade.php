@extends('layouts/main')

@section("content")


    <h1>Contact</h1>

    @if ($errors->any())
        <div class="callout alert">
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
        <fieldset>
            <label for="contact_name">Name</label>
            <input type="text" name="contact_name">
        </fieldset>
        <fieldset>
            <label for="contact_email">Email</label>
            <input type="text" name="contact_email">
        </fieldset>
        <fieldset>
            <label for="contact_message">Message</label>
            <textarea name="contact_message" id="" cols="30" rows="10"></textarea>
        </fieldset>
        <button type="submit" class="button primary">Submit</button>
    </form>
@endsection
