<x-mail::message>
Hello,
    
{{ __('You have been invited to join') }}{{ config('app.name') }}

{{ __('To accept the invitation, click on the button below and create an account.') }}

<x-mail::button :url='$acceptUrl'>
{{ __('Create Account') }}
</x-mail::button>

{{ __('If you did not expect to receive an invitation to this team, you may disregard this email.') }}

Thanks, <br>
{{ config('app.name') }}
</x-mail::message>