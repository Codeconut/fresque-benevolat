<x-filament-panels::page.simple>
    <x-slot name="heading">
        Charte de la Fresque du Bénévolat

    </x-slot>

    <x-slot name="subheading">
        @if(!auth()->user()->has_agreed_terms_at)
        {{ auth()->user()->animator->first_name }}, merci de la lire attentivement et de l'accepter pour continuer.
        @else
        Vous avez accepté la charte de la Fresque du Bénévolat le {{ auth()->user()->has_agreed_terms_at->format('d/m/Y') }}.
        @endif
    </x-slot>


    <x-filament::section collapsible>
        <x-slot name="heading">
            <div class="text-sm">Préambule</div>
        </x-slot>
        <div class="text-sm">
            La Fresque du Bénévolat est un atelier pédagogique imaginé par JeVeuxAider.gouv.fr, la plateforme publique du bénévolat, rattaché à la Direction de la Jeunesse, de l’Education Populaire et de la Vie Associative. Cet atelier a pour objectifs de sensibiliser le grand public aux enjeux du bénévolat et de faciliter le passage à l'action à travers une expérience collective.
        </div>

    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Objectifs de la Fresque du Bénévolat</div>
        </x-slot>
        <div class="text-sm">
            <ul>
                <li>- Sensibiliser au bénévolat et à son impact sur la société.</li>
                <li>- Identifier les freins et les motivations à l'engagement bénévole.</li>
                <li>- Encourager le passage à l’action pour devenir bénévole.</li>
            </ul>
        </div>

    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Participation à une Fresque du Bénévolat </div>
        </x-slot>
        <div class="text-sm">
            <ul>
                <li>- Public visé : Toute personne à partir de 16 ans souhaitant découvrir le bénévolat.
                    (Un certificat d’accord signé par les parents sera demandé aux participants mineurs)</li>
                <li>- Coût : Gratuit pour les participants</li>
                <li>- Inscription : Via le site http://jeveuxaider.gouv.fr/fresque-benevolat</li>
                <li>- Nombre de participants : De 8 à 15 personnes par atelier.</li>
            </ul>
        </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Organisation d’une Fresque du Bénévolat </div>
        </x-slot>
        <div class="text-sm">
            <ul>
                <li>- Lieux : Un lieu qui peut accueillir les participants et animateurs et dans la mesure du possible, adapté aux personnes en situation de handicap. La Fresque du Bénévolat ne peut pas se tenir dans un espace cultuel ou politique.</li>
                <li>- Communication et recrutement des participants : Les organisateurs de la Fresque du Bénévolat sont responsables de la mobilisation des participants. Ils mettent en place les actions nécessaires pour informer et recruter les participants. Ils sont invités à utiliser les canaux de communication adaptés à leur public et les kits de communication de la Fresque du Bénévolat mis à disposition.</li>
                <li>- Suivi des Fresques du Bénévolat : Les organisateurs s’engagent à publier les Fresques du Bénévolat qu’ils organisent sur le site http://jeveuxaider.gouv.fr/fresque-benevolat. L’équipe en charge de la Fresque du Bénévolat au sein de JeVeuxAider.gouv.fr assure un suivi des sessions prévues et réalisées</li>
                <li>- Annulation/ Report : En cas d’annulation et ou de report d’une Fresque du Bénévolat, les Organisateurs sont tenus d’informer les participants et JeVeuxAider.gouv.fr </li>
                <li>- Nombre de participants : De 8 à 15 personnes par atelier.</li>
            </ul>
        </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Formation des animateurs </div>
        </x-slot>
        <div class="text-sm">
            <ul>
                <li>- Conditions : Accessible aux personnes majeures résidants en France ayant déjà participé à une Fresque du Bénévolat.</li>
                <li>- Programme : Formation en deux sessions en ligne : une sur la posture de facilitateur et une sur l'animation de l'atelier.</li>
            </ul>
        </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Animation d’une Fresque du Bénévolat </div>
        </x-slot>
        <div class="text-sm">

            <h3>Prérequis</h3>
            <ul>
                <li>- Participation à au moins une Fresque du Bénévolat </li>
                <li>- Participation à la formation à l’animation de la Fresque du Bénévolat délivrée par JeVeuxAider.gouv.fr ou une organisation partenaire certifiée.</li>
                <li>- Obtention d’un certificat délivré par JeVeuxAider.gouv.fr</li>
            </ul>
            <p>Toutes personnes ayant suivi la formation à l’animation et obtenu un certificat délivré par JeVeuxAider.gouv.fr peut animer la Fresque du Bénévolat. Ce certificat garantit que l’animateur a acquis les compétences nécessaires pour conduire un atelier de manière efficace et bienveillante.</p>
            <h3>Animation d’une Fresque du Bénévolat à titre Bénévole</h3>
            <ul>
                <li>Toutes personnes qui satisfait les prérequis est en mesure d’animer une Fresque du Bénévolat.</li>
            </ul>

            <h3>Animation d’une Fresque du Bénévolat à titre Professionnelle ou en contrepartie d’une rémunération :</h3>

            <ul>
                <li>- La participation à une fresque du bénévolat est gratuite</li>
                <li>- Les bénéfices récoltés doivent servir une organisation d’intérêt général et ont une finalité solidaire (par exemple : financement d’une collecte alimentaire</li>
                <li>- L’organisation de Fresques du Bénévolat ne peuvent avoir comme unique but l’enrichissement personnel ou au titre d’une organisation quelconque</li>
            </ul>
            <p>Les animateurs bénévoles peuvent recevoir un certificat les autorisant à animer des Fresques du Bénévolat à titre professionnel.
            <p>

            <p>Point d’attention : Le certificat délivré pour animer des Fresque du Bénévolat peut être retiré si l’animateur ne respecte pas les engagement de la Charte de la Fresque du Bénévolat.</p>

        </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Impact et suivi </div>
        </x-slot>
        <div class="text-sm">
            Les organisateurs s’engagent à assurer un suivi des inscription, la relation avec les participants et un éventuel retour d’expérience à l’équipe JeVeuxAider.gouv.fr
        </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Propriété intellectuelle </div>
        </x-slot>
        <div class="text-sm">
            La Fresque du Bénévolat est une œuvre collective créée par JeVeuxAider.gouv.fr. Toute diffusion doit mentionner son origine. </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Modifications et ajouts </div>
        </x-slot>
        <div class="text-sm">
            <p>La Fresque du Bénévolat est conçue comme un outil pédagogique structuré pour garantir une expérience d’apprentissage cohérente et efficace. Bien que l’atelier soit flexible dans son utilisation, il est essentiel de respecter certaines règles concernant les modifications et ajouts.</p>
            <ul>
                <li>- <strong>Modifications interdites :</strong> La structure de l’atelier ne peut pas être modifiée, notamment l’ordre des exercices, la durée, le nombre minimum et maximum de participants, ainsi que le matériel utilisé. Les éléments tels que les cartes des débats mouvants, le photolangage, le panorama du bénévolat, la montagne des émotions, et le guide de randonnée doivent rester inchangés pour préserver l’intégrité pédagogique de l’atelier. </li>
                <li>- <strong>Ajouts autorisés :</strong>Certaines adaptations peuvent être apportées pour enrichir l’atelier, comme l’ajout de cartes missions ou d’actions supplémentaires, à condition qu’elles suivent le format « Je… » et respectent les objectifs pédagogiques. Des leviers d’action, des outils ou des prochaines étapes peuvent également être introduits pour aider les participants à mieux se projeter dans leur engagement. </li>
                <li>- <strong>Partage des versions adaptées :</strong> Toute adaptation ou ajout doit être communiqué à l’équipe de JeVeuxAider.gouv.fr. Ces versions adaptées pourront être partagées avec la communauté des animateurs pour inspirer et enrichir l’expérience au niveau local. </li>
            </ul>
            <p>Ces conditions visent à maintenir un équilibre entre la flexibilité nécessaire pour répondre aux besoins des différents publics et la préservation de l’essence et de l’efficacité pédagogique de la Fresque du Bénévolat.</p>
        </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Conditions de commercialisation </div>
        </x-slot>
        <div class="text-sm">
            <p>En tant que service public, la Fresque du Bénévolat doit rester accessible à tous. Son utilisation dans un cadre commercial est encadrée.</p>
            <ul>
                <li>- <strong>Gratuité pour les participants :</strong> La participation à la Fresque du Bénévolat doit toujours être gratuite pour les participants, quelles que soient les modalités d’organisation.
                </li>
                <li>- <strong>Utilisation par les organisations d’intérêt général :</strong> Seules les organisations d’intérêt général (associations, collectivités, établissements publics, etc.) peuvent organiser des ateliers de la Fresque du Bénévolat dans le cadre de leurs activités. Ces organisations peuvent être rémunérées par un tiers (entreprise, fondation, collectivité…) pour animer la Fresque du Bénévolat, à condition que l’accès à l’atelier reste gratuit pour les participants.
                </li>
                <li>- <strong>Rémunération des animateurs professionnels :</strong> Les animateurs professionnels ayant obtenu un certificat peuvent être rémunérés pour leurs services dans le cadre de ces ateliers. Cependant, même dans le cadre d’une prestation rémunérée à une organisation d’intérêt général, l’atelier doit rester gratuit pour les participants.
                </li>
            </ul>
            <p>Ces règles permettent aux organisations d’intérêt général d’utiliser la Fresque du Bénévolat dans leurs projets, tout en garantissant l’accessibilité gratuite à tous les publics.</p>
        </div>
    </x-filament::section>

    <x-filament::section collapsible collapsed>
        <x-slot name="heading">
            <div class="text-sm">Assurance et responsabilité</div>
        </x-slot>
        <div class="text-sm">
            <ul>
                <li>- <strong>Responsabilité des organisateurs :</strong> Les organisateurs veillent à la sécurité des participants. Ils doivent choisir des lieux d’accueil adaptés qui disposent d’une assurance responsabilité civile pour couvrir les activités de la Fresque du Bénévolat.
                </li>
                <li>
                    - <strong>Déclaration des incidents :</strong> Tout incident survenant durant l’organisation d’une Fresque du Bénévolat doit être signalé à l’équipe JeVeuxAider.gouv.fr supportfresque@jeveuxaider.beta.gouv.fr (exemples : propos discriminant et/ou insultant, accidents, etc)
                </li>
                <li>
                    - <strong>La politesse et le respect :</strong> En tant que bénévole, vous vous engagez à faire preuve de politesse et de respect lorsque vous communiquez ou interagissez avec les autres. Aucun propos discriminant et/ou insultant ne pourra être toléré.
                </li>
            </ul>
        </div>
    </x-filament::section>

    @if(!auth()->user()->has_agreed_terms_at)
    <x-filament::button wire:click="save" size="xl" class="w-full mt-8">
        J’accepte la charte
    </x-filament::button>
    @else
    <x-filament::button wire:click="save" size="xl" class="w-full mt-8" color="gray">
        Tableau de bord
    </x-filament::button>
    @endif

</x-filament-panels::page.simple>