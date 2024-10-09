<x-mail::message>
# Bonjour {{ $notifiable->animator->first_name }}, 

### J’espère que tu vas bien et que tu es prêt(e) à semer des graines de l’engagement ! 🌱

Je t’écris pour te rappeler que tu animes dans 2 jours la fresque du bénévolat : {{ $fresque->place?->name }} - le {{ \Carbon\Carbon::parse($fresque->date)->translatedFormat('j F Y') }} à {{ \Carbon\Carbon::parse($fresque->start_at)->format('H\hi') }}.

Je te partage les documents utiles pour préparer cette animation.

- [Le dossier de l'animateur](https://www.notion.so/Dossier-d-animation-de-la-Fresque-du-b-n-volat-7ef25d069ea64b71a328a688cd7193c1?pvs=21)
- [La checklist du matériel](https://www.notion.so/98c46805a3674a82865c7c4b476795f7?pvs=21)
- [Les documents à imprimer pour l'animateur (trame et discours)](https://drive.google.com/drive/folders/1F1nugEnQ-z4ojA8TEkBJtWgCdiPPKPIj?usp=sharing)

Si après avoir lu les documents précédents, tu as encore des questions sur l’animation de la fresque, tu peux consulter [le centre d’aide](https://reserve-civique.crisp.help/fr/category/fresque-du-benevolat-97jq8c/). Et si après ça tu as encore des questions, n’hésite pas à m’écrire en retour de ce mail. 

Tu vas devoir mettre à jour le statut des participants à la fresque. Tu peux le faire directement le jour J sur [ce lien]({{ $url }}).

Bonne journée, <br>
Coralie de l’équipe de la Fresque du Bénévolat

</x-mail::message>