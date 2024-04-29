<x-mail::message>
## Bonjour {{ $notifiable->first_name }},

J'espère que les courbatures ne sont pas trop importantes et que ce bon bol d'air t’as fait du bien dans ta réflexion sur l'engagement bénévole.
Un grand merci pour ta participation à cette folle aventure. 

C'était un réel plaisir pour nous d'animer cette Fresque du Bénévolat avec toi. 🤗

Pour nous permettre de rendre la fresque encore plus incroyable pour les futurs participant(e)s, peux-tu prendre 5 minutes pour nous dire ce que tu as pensé de la fresque ? 

<x-mail::button :url="$url">
Je donne mon avis
</x-mail::button>

---

### Découvre le guide

Et pour t’accompagner dans cette grande aventure qu’est le bénévolat, je t’ai concocté avec soin le guide post-fresque qui synthétise tous les outils, informations et conseils partagés durant la session (et pleins d'autres pépites)

<a target="_blank" href="https://jeveuxaider.notion.site/Fresque-du-B-n-volat-et-apr-s-af11cb0e09724e278f76e32973a2e440?pvs=4">Je découvre le guide</a>

---

<x-mail::signature :fresque="$fresque">
Merci pour ton aide,
</x-mail::signature>

</x-mail::message>
