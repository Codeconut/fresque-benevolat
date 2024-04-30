<x-mail::message>
## {{ $notifiable->first_name }}, quelles sont les nouvelles depuis ta Fresque du Bénévolat ?

### Salut {{ $notifiable->first_name }},

Déjà 6 semaines depuis notre aventure à "La Fresque du Bénévolat" ! 🌟
Si le temps file, l'envie d'agir, elle est toujours là. Du moins j’espère. 🤣
De toi à moi tu t'es lancé dans le bénévolat depuis ta fresque ? (promis je ne le répèterai à personne) 

<x-mail::button :url="$url">
Raconte-moi ici
</x-mail::button>

---

### JeVeuxAider.gouv.fr

Si tu n’as pas encore déniché LA mission de bénévolat ? Pas de panique Marie-Monique, JeVeuxAider.gouv.fr est là pour toi, avec avec des propositions d’actions dans de nombreux domaines : solidarité, éducation, environnement, pour une heure ou pour plusieurs jours…

<x-mail::button url="https://jeveuxaider.gouv.fr">
Je trouve ma mission
</x-mail::button>

---

<x-mail::signature :fresque="$fresque">
À bientôt pour de nouvelles aventures ?
</x-mail::signature>

</x-mail::message>
