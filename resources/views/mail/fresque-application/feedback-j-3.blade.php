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

## Découvre le guide

Je t’ai soigneusement préparé un guide ultime post-fresque, il contient :

💡 Les essentiels à retenir<br>
✅ Tes prochaines étapes<br>
💬 Le feedback<br>
✨ Valoriser ta participation<br>
📊 Les études pour aller plus loin<br>
📸 Les photos pour les souvenirs<br>

<x-mail::button url="https://jeveuxaider.notion.site/Fresque-du-B-n-volat-et-apr-s-af11cb0e09724e278f76e32973a2e440?pvs=4">
Je découvre le guide
</x-mail::button>

---

<x-mail::signature :fresque="$fresque">
Merci pour ton aide,
</x-mail::signature>

</x-mail::message>
