<x-mail::message>
## Wow {{ $notifiable->first_name }},

Déjà 12 semaines depuis que tu as participé à la Fresque du Bénévolat ! Le temps file, mais l'envie de faire une différence reste, n'est-ce pas ? 🚀

<x-mail::button :url="$url">
Dernière chance de partager ton parcours !
</x-mail::button>

---

### Missions de bénévolat

Si tu n'as pas encore trouvé la mission de bénévolat qui te convient, n’hésite pas à consulter les missions disponibles près de chez toi sur JeVeuxAider.gouv.fr.

<a target="_blank" href="https://jeveuxaider.gouv.fr">Je trouve une mission de bénévolat</a>

---

<x-mail::signature :fresque="$fresque">
Bonne journée,
</x-mail::signature>

</x-mail::message>
