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
            Cet e-mail a été envoyé suite à votre inscription à une fresque du Bénévolat sur
            fresquedubenevolat.jeveuxaider.gouv.fr
        </x-mail::footer>
    </x-slot:footer>
</x-mail::layout>
