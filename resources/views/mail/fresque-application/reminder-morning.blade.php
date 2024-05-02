<x-mail::message>
## Tic tac, tic tac…

### Bonjour {{ $notifiable->first_name }},

Bonne nouvelle : la Fresque du Bénévolat, c’est déjà aujourd’hui !<br />
On se retrouve à {{ \Carbon\Carbon::parse($fresque->start_at)->format('H\hi') }} à l’adresse suivante : {{ $fresque->place->full_address }}.

<x-mail::fresque-title :fresque="$fresque" />

<x-mail::fresque-cover :fresque="$fresque" />

Tu peux retrouver toutes les informations sur cette fresque ici

<x-mail::button :url="$url">Détails de la fresque</x-mail::button>

---

### Un empêchement ?

Tu peux annuler ta participation à tout moment en cliquant <a target="_blank"
href="{{ route('fresques.applications.confirmation-presence', ['fresqueApplication' => $notifiable]) }}">sur le
lien suivant</a>

---

Tu as des questions ? Partage-les moi en répondant à ce mail directement, je te ferai un retour avec grand plaisir.

<x-mail::signature :fresque="$fresque">
À tout à l’heure !
</x-mail::signature>

</x-mail::message>
