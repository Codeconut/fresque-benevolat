<x-mail::message>
Bonjour,

Vous avez été invité pour rejoindre la Fresque du Bénévolat

Pour accepter l'invitation, cliquez sur le bouton ci-dessous et créez un compte.

<x-mail::button :url='$acceptUrl'>
Créer son compte
</x-mail::button>

{{ $acceptUrl }}

Si vous ne vous attendiez pas à recevoir une invitation à cette équipe, vous pouvez ignorer cet e-mail.

Merci, <br>
{{ config('app.name') }}
</x-mail::message>