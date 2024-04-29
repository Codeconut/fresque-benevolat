<x-mail::message>
## Bonjour {{ $notifiable->first_name }}

Un grand merci pour ton inscription à la Fresque du Bénévolat 🙌 J'ai hâte d'animer ce nouveau format inédit avec
toi.

<x-mail::fresque-title :fresque="$fresque" />

<x-mail::fresque-cover :fresque="$fresque" />

<x-mail::fresque-infos-pratiques :fresque="$fresque" />

Je suis très enthousiaste à l'idée de passer ce moment ensemble, j'espère que toi aussi ! 🤗

---

### Proposez à vos ami(e)s de participer !

Plus on est de fous, plus on rit 😊<br />
N’hésitez pas à partager la fresque à vos ami(e)s pour qu’ils puissent aussi s’inscrire

<x-mail::button :url="$url">Je partage le lien de la fresque</x-mail::button>

---

### Un empêchement ?

Vous pouvez annuler votre participation à tout moment en cliquant <a target="_blank" href="{{ route('fresques.applications.confirmation-presence', ['fresqueApplication' => $notifiable])}}">sur le lien suivant</a>

---

<x-mail::signature :fresque="$fresque">
Très belle fin de semaine et à bientôt !
</x-mail::signature>


</x-mail::message>
