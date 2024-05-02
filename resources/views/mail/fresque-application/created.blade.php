<x-mail::message>
## Embarquement imminent !

### Bonjour {{ $notifiable->first_name }},

Un grand merci pour ton inscription à la Fresque du Bénévolat 🙌 J'ai hâte d'animer ce nouveau format inédit avec
toi.

<x-mail::fresque-title :fresque="$fresque" />

<x-mail::fresque-cover :fresque="$fresque" />

Je suis très enthousiaste à l'idée de passer ce moment ensemble, j'espère que toi aussi ! 🤗

---

### Propose à tes ami(e)s de participer !

Plus on est de fous, plus on rit : propose à tes proches de rejoindre l’aventure ! 😊

<x-mail::button :url="$url">Je partage le lien de la fresque</x-mail::button>

---

### Un empêchement ?

Tu peux annuler ta participation à tout moment en cliquant <a target="_blank" href="{{ route('fresques.applications.confirmation-presence', ['fresqueApplication' => $notifiable])}}">sur le lien suivant</a>

---

<x-mail::fresque-faq :fresque="$fresque" />

---

<x-mail::signature :fresque="$fresque">
Très belle fin de semaine et à bientôt !
</x-mail::signature>

</x-mail::message>
