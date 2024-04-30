<x-mail::message>
## Ça va fresquer ! 💃

### Bonjour {{ $notifiable->first_name }},

Plus que 2 jours avant qu’on se retrouve dans le monde réel à l’occasion de la Fresque du Bénévolat.

<x-mail::fresque-title :fresque="$fresque" />

<x-mail::fresque-cover :fresque="$fresque" />

Afin de finaliser l’organisation, j’ai besoin que tu me confirmes ta présence en 2 clics

<x-mail::button :url="$url">
Je dis si je viens ici (ou pas)
</x-mail::button>

Connaitre le nombre exact de participants est crucial pour que je puisse organiser un super atelier.

Tu as des questions ? Tu peux retrouver toutes les informations sur la fresque <a href="{{ route('fresques.show', $fresque) }}" target="_blank">ici</a>, ou répondre à ce mail directement, je te ferai un retour avec grand plaisir.

<x-mail::signature :fresque="$fresque">
À très vite,
</x-mail::signature>

</x-mail::message>
