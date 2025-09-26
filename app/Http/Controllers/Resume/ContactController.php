<?php

namespace App\Http\Controllers\Resume;

use App\Http\Requests\ContactRequest;
use App\Libraries\ContactLibrary;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __construct(
        protected readonly ContactLibrary $contactLibrary,
    ) {
        $this->middleware('check.setting:is_show_contact', ['only' => ['contact', 'store']]);
    }

    public function contact()
    {
        return view('resume.contact');
    }
    
    public function store(ContactRequest $request)
    {
        $contact = $this->contactLibrary->save($request->validated());
        $user = tenant()->user;
        Mail::to($user->email)->send(
            new ContactMail($contact, $user)
        );
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
