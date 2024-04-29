<script setup>
import { Head, Link, router } from '@inertiajs/vue3'
import { RiExternalLinkLine } from '@remixicon/vue'
import Newsletter from '@/Components/Sections/Newsletter.vue'

const gouvLinks = [
  {
    name: 'legifrance.gouv.fr',
    url: 'https://legifrance.gouv.fr',
  },
  {
    name: 'gouvernement.fr',
    url: 'https://gouvernement.fr',
  },
  {
    name: 'service-public.fr',
    url: 'https://service-public.fr',
  },

  {
    name: 'data.gouv.fr',
    url: 'https://www.data.gouv.fr',
  },
]
</script>

<template>
  <div class="">
    <Newsletter />
    <footer role="contentinfo" class="relative z-1 border-t-2 border-[#000091]">
      <div class="bg-gray-50 py-8">
        <div class="container">
          <div class="grid grid-cols-1 md:grid-cols-6 text-xs gap-8">
            <div>
              <div class="font-bold mb-8">Les activités bénévoles</div>
              <div class="grid grid-cols-1 gap-4">
                <a class="link" href="https://www.jeveuxaider.gouv.fr/activites/maraude">Maraude</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/activites/soins-aux-animaux"
                  >Soins aux animaux</a
                >
                <a
                  class="link"
                  href="https://www.jeveuxaider.gouv.fr/activites/alphabetisation-apprentissage-du-francais-fle"
                  >Alphabétisation</a
                >
                <a
                  class="link"
                  href="https://www.jeveuxaider.gouv.fr/activites/ramassage-de-dechets"
                  >Ramassage de déchets</a
                >
                <a
                  class="link"
                  href="https://www.jeveuxaider.gouv.fr/activites/soutien-scolaire-et-formation"
                  >Soutien scolaire</a
                >
                <a
                  class="link"
                  href="https://www.jeveuxaider.gouv.fr/activites/aide-aux-demarches-administratives"
                  >Aides aux démarches administratives</a
                >
                <a
                  class="link"
                  href="https://www.jeveuxaider.gouv.fr/activites/droit-et-conseil-juridique"
                  >Droit et conseil juridique</a
                >
                <a
                  class="link"
                  href="https://www.jeveuxaider.gouv.fr/activites/ecoute-aide-psychologique"
                  >Ècoute / Aide psychologique</a
                >
                <a class="link" href="https://www.jeveuxaider.gouv.fr/activites/evenementiel"
                  >Événementiel</a
                >
              </div>
            </div>
            <div class="">
              <div class="font-bold mb-8">Les autres fresques</div>
              <div class="grid grid-cols-1 gap-4">
                <a class="link" href="#">La fresque du climat</a>
                <a class="link" href="#">La fresque du numérique</a>
                <a class="link" href="#">Lien de navigation</a>
                <a class="link" href="#">Lien de navigation</a>
                <a class="link" href="#">Lien de navigation</a>
                <a class="link" href="#">Lien de navigation</a>
                <a class="link" href="#">Lien de navigation</a>
                <a class="link" href="#">Lien de navigation</a>
              </div>
            </div>

            <div class="md:col-span-4">
              <div class="font-bold mb-8">Le bénévolat par ville</div>
              <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/amiens">Amiens</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/angers">Angers</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/bordeaux">Bordeaux</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/brest">Brest</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/caen">Caen</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/clermont-ferrand"
                  >Clermont-Ferrand</a
                >
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/dijon">Dijon</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/grenoble">Grenoble</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/le-havre">Le Havre</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/le-mans">Le Mans</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/lille">Lille</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/limoges">Limoges</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/lyon">Lyon</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/marseille"
                  >Marseille</a
                >
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/metz">Metz</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/montpellier"
                  >Montpellier</a
                >
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/mulhouse">Mulhouse</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/nancy">Nancy</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/nantes">Nantes</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/nice">Nice</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/nimes">Nîmes</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/orleans">Orléans</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/paris">Paris</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/perpignan"
                  >Perpignan</a
                >
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/reims">Reims</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/rennes">Rennes</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/rouen">Rouen</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/saint-etienne"
                  >Saint-Étienne</a
                >
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/strasbourg"
                  >Strasbourg</a
                >
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/toulon">Toulon</a>
                <a class="link" href="https://www.jeveuxaider.gouv.fr/villes/toulouse">Toulouse</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white py-8">
        <div class="container">
          <div class="lg:flex lg:justify-between lg:items-center lg:gap-8">
            <div class="">
              <Link
                href="/"
                class="flex flex-col flex-wrap gap-4 sm:gap-6 sm:flex-row lg:gap-8 xl:gap-12"
              >
                <img
                  src="/images/logos/republique-francaise-logo.svg"
                  alt="République Française"
                  width="6500"
                  height="5870"
                  class="w-[76px] lg:w-[127px]"
                />

                <img src="/images/logos/jeveuxaider-logo.svg" alt="" width="251" height="41" />
              </Link>
            </div>

            <div class="">
              <div class="text-[#383838] text-sm lg:max-w-lg leading-relaxed mt-8 mb-6">
                La Fresque du Bénévolat par JeVeuxAider.gouv.fr
              </div>

              <div class="flex flex-wrap gap-3">
                <a
                  v-for="link in gouvLinks"
                  :key="link.url"
                  class="hover:underline flex items-center gap-1 font-bold text-sm text-[#3A3A3A] mr-2"
                  :href="link.url"
                  target="_blank"
                  rel="noopener"
                >
                  {{ link.name }}
                  <RiExternalLinkLine class="relative top-[-1px] h-4 w-4 fill-current" />
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr />

      <div class="bg-white py-4">
        <div class="container">
          <div class="text-gray-600 text-xs">
            <div class="divide-x">
              <Link
                class="pl-0 cursor-pointer hover:underline pr-3 my-1 inline-block"
                href="https://www.jeveuxaider.gouv.fr/accessibilite"
                >Accessibilité : partiellement conforme</Link
              >
              <a
                class="cursor-pointer hover:underline px-3 my-1 inline-block"
                href="https://www.jeveuxaider.gouv.fr/politique-de-confidentialite"
                target="_blank"
              >
                Données personnelles
              </a>
              <a
                class="cursor-pointer hover:underline px-3 my-1 inline-block"
                href="https://www.jeveuxaider.gouv.fr/mentions-legales"
                target="_blank"
              >
                Mentions légales
              </a>
              <a
                class="cursor-pointer hover:underline px-3 my-1 inline-block"
                href="https://www.jeveuxaider.gouv.fr/conditions-generales-d-utilisation"
                target="_blank"
              >
                CGU
              </a>
              <a
                class="cursor-pointer hover:underline px-3 my-1 inline-block"
                href="https://www.jeveuxaider.gouv.fr/plan-du-site"
                target="_blank"
              >
                Plan du site
              </a>
            </div>

            <div class="mt-6">
              Sauf mention contraire, tous les textes de ce site sont sous
              <a
                href="https://github.com/etalab/licence-ouverte/blob/master/LO.md"
                target="_blank"
                class="inline-flex items-baseline"
              >
                <span class="underline">licence etatlab-2.0</span>
                <RiExternalLinkLine class="flex-none ml-1" width="10" height="10" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style lang="postcss" scoped>
.link {
  @apply hover:underline text-gray-600 truncate;
}
</style>
