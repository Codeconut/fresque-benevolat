<x-mail::message>
## Bonjour {{ $notifiable->first_name }},

Déjà trois semaines se sont écoulées depuis notre incroyable rencontre lors de "La Fresque du Bénévolat". J'espère que l'élan de générosité et l'enthousiasme pour le bénévolat que nous avons partagés continuent de t'inspirer au quotidien !

Nous sommes curieux de savoir si cette expérience a semé en toi la graine de l'action. As-tu eu l'occasion de franchir le pas vers une mission de bénévolat ou d'entamer des démarches pour en trouver une ? Dis-nous tout en cliquant sur le lien ci-dessous : 
<x-mail::button :url="$url">
Partagez votre parcours
</x-mail::button>

---

### Missions de bénévolat

Si tu es encore à la recherche de l'opportunité idéale ou si tu as des questions sur comment t'engager, tu peux trouver une mission de bénévolat sur JeVeuxAider.gouv.fr, la plateforme publique du bénévolat ! Plus de 18000 missions sont disponibles, tu y trouveras sûrement ton bonheur ! 

<a target="_blank" href="https://jeveuxaider.gouv.fr">Je trouve une mission de bénévolat</a>

---

<x-mail::signature :fresque="$fresque">
Merci pour ton aide,
</x-mail::signature>

</x-mail::message>
