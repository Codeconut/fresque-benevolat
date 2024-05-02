<x-mail::message>
## Pourtant… on a parcouru le chemin, on a tenu la distance 🎵

Wow {{ $notifiable->first_name }}, déjà 12 semaines depuis que tu as participé à la Fresque du Bénévolat ! Le temps file, mais l'envie de gravir des sommets est toujours là, n'est-ce pas ? 🌄

Pour moi, c’est tout ce qui compte dans le bénévolat : avoir envie. Envie de rencontrer du beau monde, faire bouger les lignes, partager ses connaissances, apprendre et en sortir transformé. 

Je ne peux pas résister à l'envie de te demander une dernière fois : as-tu réalisé une mission de bénévolat depuis la fresque ?

<x-mail::button :url="$url">
Je partage mon parcours !
</x-mail::button>

---

Si tu n'as pas encore trouvé la mission de bénévolat qui te convient, n’hésite pas à consulter les missions disponibles près de chez toi sur JeVeuxAider.gouv.fr.

<x-mail::button url="https://api.api-engagement.beta.gouv.fr/r/campaign/6630fdf5660b888f939dd583">
Je trouve ma mission
</x-mail::button>

---

<x-mail::signature :fresque="$fresque">
Bonne journée et merci pour ton engagement,
</x-mail::signature>

PS : C’est mon dernier message à ce sujet - promis, je ne t'embête plus après ça ! 


</x-mail::message>
