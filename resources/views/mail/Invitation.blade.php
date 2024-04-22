@component('mail::message')

<h1>Email Verification</h1>

<p>You have been invited to register. Click the link below to proceed:</p>

<div style="text-align:left">
    @component('mail::button', ['url' =>  $url ])
       Register Now
    @endcomponent
</div>


Thanks,<br>
<b>Crypto Wiz Guy&trade;</b>

@endcomponent
