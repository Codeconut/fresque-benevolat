<x-mail::message>
## Bonjour {{ $notifiable->first_name }},

Bonne nouvelle : la Fresque du Bénévolat, c’est aujourd’hui !

<x-mail::fresque-title :fresque="$fresque" />

<x-mail::fresque-cover :fresque="$fresque" />

<x-mail::fresque-infos-pratiques :fresque="$fresque" />

Tu peux retrouver toutes les informations sur cette fresque ici

<x-mail::button :url="$url">Détails de la fresque</x-mail::button>

---

### Un empêchement ?

Tu peux annuler ta participation à tout moment en cliquant <a target="_blank" href="{{ route('fresques.applications.confirmation-presence', ['fresqueApplication' => $notifiable])}}">sur le lien suivant</a>

---

<x-mail::signature :fresque="$fresque">
À tout à l’heure !
</x-mail::signature>

</x-mail::message>
