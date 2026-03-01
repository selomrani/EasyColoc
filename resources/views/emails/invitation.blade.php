<x-mail::message>
# You've been invited!

You have been invited to join the colocation: **{{ $colocationName }}**.

To accept this invitation and join the group, please click the button below.

<x-mail::button :url="route('invitations.accept', ['token' => $token])">
Join Colocation
</x-mail::button>

If you were not expecting this invitation, you can safely ignore this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>