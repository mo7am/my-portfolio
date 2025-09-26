@component('mail::message')
# Hello Mr {{ $user->first_name }},

You’ve been received new message from {{ $contact->name }}. Here are the details:

**Name:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
**Message:**  
{{ $contact->message }}

Thanks,  
**{{ config('app.name') }}**
@endcomponent
