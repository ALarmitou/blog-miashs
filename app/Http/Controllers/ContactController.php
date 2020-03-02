<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create(){
        return view("contact");
    }

    public function store(ContactRequest $request){
        $request->validated();
        $contact = $request->all();
        $contact["contact_date"] = now();
        Contact::create($contact);
        return redirect("contact")->with("message","Demande de contact envoyée !");
    }
}
