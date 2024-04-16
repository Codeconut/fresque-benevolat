<x-mail::message>
## Bonjour {{ $notifiable->first_name }}

Plus que {{ $diffInDays }} jours avant de participer à la Fresque du Bénévolat.

<p style="text-align: center; margin-top: 40px;">
<span class="fresque-title">{{ $fresque->place->name }}
<br />le {{ \Carbon\Carbon::parse($fresque->date)->format('d F Y') }} à {{ $fresque->schedules }}</span>
<br />{{ $fresque->place->full_address }}
</p>

<a href="{{ route('fresques.show' , $fresque) }}" target="_blank">
<img src="{{ asset('storage/'.$fresque->cover) }}" style="margin-bottom: 24px;">
</a>

Afin de finaliser l’organisation, j’ai besoin que tu me dises si tu seras présent ou non

<x-mail::button :url="$url">
Je confirme ma présence
</x-mail::button>

Savoir le nombre exact de participants est crucial pour que je puisse organiser l’atelier de la meilleure façon possible.

Tu as des questions ? Tu peux retrouver toutes les informations sur la fresque ici, ou répondre à ce mail directement, j'y répondrais avec plaisir.

À très vite,

</x-mail::message>
