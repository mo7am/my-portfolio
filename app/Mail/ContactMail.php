<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public Contact $contact;
    public User $user;

    public function __construct(Contact $contact, User $user)
    {
        $this->contact = $contact;
        $this->user = $user;
    }

    public function build(): self
    {
        return $this->subject("New Contact Message from {$this->contact->name}")
            ->markdown('emails.contacts.message')
            ->with([
                'contact' => $this->contact,
                'user' => $this->user,
            ]);
    }
}
