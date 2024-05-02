<x-mail::message>
## Coucou c’est moi, la petite voix de tes bonnes résolutions 🤫

### Bonjour {{ $notifiable->first_name }},

Déjà 3 semaines se sont écoulées depuis notre incroyable rencontre lors de "La Fresque du Bénévolat". J'espère que l'élan de générosité et l'enthousiasme pour le bénévolat que nous avons partagés continuent de t'inspirer au quotidien !

Nous sommes curieux de savoir si cette expérience t’a donné envie de passer à l’action. As-tu eu l'occasion de franchir le pas vers une mission de bénévolat ou d'entamer des démarches pour en trouver une ? Dis-nous tout en cliquant sur le lien ci-dessous  

<x-mail::button :url="$url">
Je partage mon itinéraire
</x-mail::button>

---

Si tu es encore à la recherche de l'occasion idéale ou si tu as des questions sur comment t'engager, tu peux trouver une annonce de bénévolat sur JeVeuxAider.gouv.fr, la plateforme publique du bénévolat ! Plus de 18000 missions sont disponibles, tu y trouveras sûrement ton bonheur ! 

<x-mail::button url="https://api.api-engagement.beta.gouv.fr/r/campaign/6630fc36660b888f939dca8f">
Je trouve une mission de bénévolat
</x-mail::button>

---

<x-mail::signature :fresque="$fresque">
Merci pour ton aide,
</x-mail::signature>

</x-mail::message>
