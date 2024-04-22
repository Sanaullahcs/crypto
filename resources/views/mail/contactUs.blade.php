@component('mail::message')

<h2>Contact Us Request</h2>

<p><strong>Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>
<p><strong>Phone:</strong> {{ $contact->phone }}</p>
<p><strong>Subject:</strong> {{ $contact->subject }}</p>
<p><strong>Message:</strong> {{ $contact->message }}</p>


Thanks,<br>
<b>Crypto Wiz Guy&trade;</b>

@endcomponent

