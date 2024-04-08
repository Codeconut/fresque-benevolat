<x-mail::message>
# Bonjour {{ $notifiable->first_name }}

Plus que {{ $diffInDays }} jours avant de participer à la fresque du bénévolat.

## La Fresque

Afin de finaliser l’organisation, j’ai besoin que tu me dises si tu seras présent ou non
{{ $url }}

<x-mail::button :url="$url">
Je confirme ma présence
</x-mail::button>

Savoir le nombre exact de participants est crucial pour que je puisse organiser l’atelier de la meilleure façon possible.

Tu as des questions ? Tu peux retrouver toutes les informations sur la fresque ici, ou répondre à ce mail directement, j'y répondrais avec plaisir.
</x-mail::message>
