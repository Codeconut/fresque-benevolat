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
              <div class="font-bold mb-8">Le bénévolat en France</div>
              <div class="grid grid-cols-1 gap-4">
                <Link class="link" href="#">Bénévolat à la retraite</Link>
                <Link class="link" href="#">Bénévolat pendant les fêtes</Link>
                <Link class="link" href="#">Associations harcèlement scolaires</Link>
                <Link class="link" href="#">Associations personnes seules</Link>
                <Link class="link" href="#">Associations personnes âgées</Link>
                <Link class="link" href="#">Associations santé</Link>
                <Link class="link" href="#">Associations enfance</Link>
                <Link class="link" href="#">Bénévolat de compétences</Link>
              </div>
            </div>
            <div class="">
              <div class="font-bold mb-8">Les autres fresques</div>
              <div class="grid grid-cols-1 gap-4">
                <Link class="link" href="#">La fresque du climat</Link>
                <Link class="link" href="#">La fresque du numérique</Link>
                <Link class="link" href="#">Lien de navigation</Link>
                <Link class="link" href="#">Lien de navigation</Link>
                <Link class="link" href="#">Lien de navigation</Link>
                <Link class="link" href="#">Lien de navigation</Link>
                <Link class="link" href="#">Lien de navigation</Link>
                <Link class="link" href="#">Lien de navigation</Link>
              </div>
            </div>

            <div class="md:col-span-4">
              <div class="font-bold mb-8">Le bénévolat par ville</div>
              <div class="grid grid-cols-4 gap-4">
                <Link class="link" href="#"> Amiens</Link>
                <Link class="link" href="#">Angers</Link>
                <Link class="link" href="#">Besançon</Link>
                <Link class="link" href="#">Bordeaux</Link>
                <Link class="link" href="#">Brest</Link>
                <Link class="link" href="#">Caen</Link>
                <Link class="link" href="#">Clermont-Ferrand</Link>
                <Link class="link" href="#">Dijon</Link>
                <Link class="link" href="#">Grenoble</Link>
                <Link class="link" href="#">Le Havre</Link>
                <Link class="link" href="#">Le Mans</Link>
                <Link class="link" href="#">Lille</Link>
                <Link class="link" href="#">Limoges</Link>
                <Link class="link" href="#">Lyon</Link>
                <Link class="link" href="#">Marseille</Link>
                <Link class="link" href="#">Metz</Link>
                <Link class="link" href="#">Montpellier</Link>
                <Link class="link" href="#">Mulhouse</Link>
                <Link class="link" href="#">Nancy</Link>
                <Link class="link" href="#">Nantes</Link>
                <Link class="link" href="#">Nice</Link>
                <Link class="link" href="#">Nîmes</Link>
                <Link class="link" href="#">Orléans</Link>
                <Link class="link" href="#">Paris</Link>
                <Link class="link" href="#">Perpignan</Link>
                <Link class="link" href="#">Reims</Link>
                <Link class="link" href="#">Rennes</Link>
                <Link class="link" href="#">Rouen</Link>
                <Link class="link" href="#">Saint-Étienne</Link>
                <Link class="link" href="#">Strasbourg</Link>
                <Link class="link" href="#">Toulon</Link>
                <Link class="link" href="#">Toulouse</Link>
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
              <Link class="pl-0 cursor-pointer hover:underline pr-3 my-1 inline-block" href="#"
                >Accessibilité : non conforme</Link
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
              <!-- <Link class="cursor-pointer hover:underline px-3 my-1 inline-block" href="#"
                >Mentions légales</Link
              >
              <Link class="cursor-pointer hover:underline px-3 my-1 inline-block" href="#"
                >CGU</Link
              > -->
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
