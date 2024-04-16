<x-mail::message>
## Bonjour {{ $notifiable->first_name }}

Un grand merci pour ton inscription à la Fresque du Bénévolat 🙌 J'ai hâte d'animer ce nouveau format inédit avec
toi.

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


Je suis très enthousiaste à l'idée de passer ce moment ensemble, j'espère que toi aussi ! 🤗

---

### Proposez à vos ami(e)s de participer !

Plus on est de fous, plus on rit 😊 N’hésitez pas à partager la fresque à vos ami(e)s pour qu’ils puissent aussi s’inscrire

<x-mail::button :url="$url">Je partage le lien de la fresque</x-mail::button>

---

### Un empêchement ?

Vous pouvez annuler votre participation à tout moment en cliquant <a target="_blank" href="{{ route('fresques.applications.confirmation-presence', ['fresqueApplication' => $notifiable])}}">sur le lien suivant</a>

---

Très belle fin de semaine et à bientôt !<br />
Coralie, créatrice de la Fresque du bénévolat 🌞

</x-mail::message>
