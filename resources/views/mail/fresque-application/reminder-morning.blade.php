<x-mail::message>
## Bonjour {{ $notifiable->first_name }}

Bonne nouvelle : la Fresque du Bénévolat, c’est aujourd’hui !

<p style="text-align: center; margin-top: 40px;">
<span class="fresque-title">{{ $fresque->place->name }}
<br />le {{ \Carbon\Carbon::parse($fresque->date)->format('d F Y') }} à {{ $fresque->schedules }}</span>
<br />{{ $fresque->place->full_address }}
</p>

<a href="{{ $url }}" target="_blank">
<img src="{{ asset('storage/'.$fresque->cover) }}" style="margin-bottom: 24px;">
</a>

<div style="background-color: #DEE5FD; color: #161616; padding: 24px; margin-bottom: 24px;">
<h3 style="font-size: 22px; font-weight: 700;">ℹ️ Infos pratiques</h3>

{{ $fresque->summary }}
</div>


Tu peux retrouver toutes les informations sur cette fresque ici

<x-mail::button :url="$url">Détails de la fresque</x-mail::button>

---

### Un empêchement ?

Vous pouvez annuler votre participation à tout moment en cliquant <a target="_blank" href="{{ route('fresques.applications.confirmation-presence', ['fresqueApplication' => $notifiable])}}">sur le lien suivant</a>

---

À tout à l’heure !<br />
Les futurs animateurs 🌞

</x-mail::message>
