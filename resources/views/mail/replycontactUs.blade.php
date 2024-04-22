@component('mail::message')



<p>Hello {{ $contact->first_name }},</p>
<p>This is a reply to your inquiry. Here are the details:</p>
<ul>
    <li><strong>Name:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</li>
    <li><strong>Email:</strong> {{ $contact->email }}</li>
    <li><strong>Subject:</strong> {{ $contact->subject }}</li>
    <li><strong>Message:</strong> {{ $message }}</li> <!-- Display the message -->
</ul>

Thanks,<br>
<b>Crypto Wiz Guy&trade;</b>

@endcomponent

