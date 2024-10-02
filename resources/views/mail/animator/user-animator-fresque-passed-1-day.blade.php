<x-mail::message>
# Bonjour {{ $notifiable->animator->first_name }}, 

### Merci encore pour ton engagement et ton animation de la Fresque du Bénévolat le {{ \Carbon\Carbon::parse($fresque->date)->translatedFormat('j F Y') }}. Ta mobilisation a été précieuse !

Pour clôturer cette belle session, il te reste quelques actions simples à effectuer afin de partager et valoriser cette expérience :

1. **Mettre à jour la présence des participants** directement sur le site si tu ne l’as pas encore fait : <a href="{{ $url }}">{{ $url }}</a>
2. **Crée un dossier** sur [ce Drive](https://drive.google.com/drive/folders/1JddaSS8AKWbmn5jgb9gkIx6uwF-LMiq4), en suivant la nomenclature : AAA_MM_JJ_Lieu_Ville *(ex. : 2024_03_01_Hôtel_Pasteur_Rennes)*, et ajoute les photos de la session.
3. **Partage la photo de groupe** et un retour d'expérience d'un(e) participant(e) sur l'**espace de discussion dédié aux animateur(rice)s**.
4. **Valorise ton expérience** sur les réseaux sociaux. Pour t’aider, nous avons rédigé des posts prêts à l’emploi disponibles ici

Si tu as des retours ou des questions après la Fresque du Bénévolat, tu peux m’écrire, j’y répondrais avec plaisir. 

J’espère que tu es fière de toi, grâce à toi, des vocations sont nées !

Bonne journée, <br>
Coralie de l’équipe de la Fresque du Bénévolat

</x-mail::message>