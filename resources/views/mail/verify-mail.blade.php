@component('mail::message')
<b style="color: black">Hi {{$name}}</b>

You’re almost ready to start enjoying shopping on {{env('APP_NAME')}} <br>
Simply click the big button below to verify your email address

@component('mail::button', ['url' => $verifyLink])
    Verify Email Address
@endcomponent
If you did not create an account, no further action is required.<br><br>
Regards,<br>
{{ config('app.name') }}<br><br>
<hr>

If you’re having trouble clicking the "Verify Email Address" button, copy and paste the URL below into your web browser: <a href="{{$verifyLink}}">{{$verifyLink}}</a>
@endcomponent
