<x-mail::layout>
<x-slot:header>
<x-mail::header :url="config('app.url')">
<img src="{{ asset('images/logos/fresque-benevolat-logo.svg') }}" alt="Logo de la fresque du bénévolat"
width="200">
</x-mail::header>
</x-slot:header>
{{ $slot }}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset
<x-slot:footer>
<x-mail::footer>

<div class="footer-links">

[Trouver une mission](https://jeveuxaider.gouv.fr/missions-benevolat)
[Toutes les fresques du bénévolat](https://www.jeveuxaider.gouv.fr/fresque-benevolat)

</div>

<div class="footer-socials">

[![Instagram]({{ asset('images/mail/instagram.svg') }})](https://www.instagram.com/jeveuxaider_gouv/?hl=fr)
[![Facebook]({{ asset('images/mail/facebook.svg') }})](https://www.facebook.com/jeveuxaider.gouv.fr/)
[![Twitter]({{ asset('images/mail/twitter.svg') }})](https://twitter.com/ReserveCivique)
[![Linkedin]({{ asset('images/mail/linkedin.svg') }})](https://www.linkedin.com/company/jeveuxaider-gouv-fr?originalSubdomain=fr)

</div>

Cet e-mail a été envoyé suite à votre inscription à une Fresque du Bénévolat

</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
