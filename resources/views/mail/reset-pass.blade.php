@component('mail::message')
<b style="color: black">Hi {{$name}}</b>

We've received a request to reset your password. If you didn't make the request, just ignore this email. Otherwise, you can reset your password using this link.

@component('mail::button', ['url' => $resetLink])
    Reset my password
@endcomponent
Thank you for using our application!<br><br>
Regards,<br>
{{ config('app.name') }}<br><br>
<hr>

If you’re having trouble clicking the "Reset my password" button, copy and paste the URL below into your web browser: <a href="{{$resetLink}}">{{$resetLink}}</a>
@endcomponent
