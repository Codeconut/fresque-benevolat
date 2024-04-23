<x-mail::message>
## Bonjour {{ $notifiable->first_name }}

Plus que 2 jours avant de participer à la Fresque du Bénévolat.

<x-mail::fresque-title :fresque="$fresque" />

<x-mail::fresque-cover :fresque="$fresque" />

Afin de finaliser l’organisation, j’ai besoin que tu me dises si tu seras présent ou non

<x-mail::button :url="$url">
Je confirme ma présence
</x-mail::button>

Savoir le nombre exact de participants est crucial pour que je puisse organiser l’atelier de la meilleure façon possible.

Tu as des questions ? Tu peux retrouver toutes les informations sur la fresque ici, ou répondre à ce mail directement, j'y répondrais avec plaisir.

À très vite,

</x-mail::message>
