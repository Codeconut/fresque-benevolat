<script setup>
import { Button } from '@/Components/Dsfr'
import { Link } from '@inertiajs/vue3'
// import gimmickUrl from '@/assets/images/icons/gimmick.svg'
</script>

<template>
  <div class="relative py-10 lg:py-20">
    <div class="relative container">
      <div class="mb-14">
        <h2 class="relative inline text-4xl lg:text-5xl lg:leading-[56px] font-bold">
          Ils sont partenaires de la Fresque
        </h2>
        <div class="text-xl lg:text-2xl text-[#666666] mt-4">
          Rejoignez-les !
          <a class="text-dsfr-blue underline" href="mailto:fresque@dsfds.com">Écrivez-nous</a>
        </div>
      </div>
      <div id="partenaires-logos" class="flex flex-wrap gap-4">
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-probonolab.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-probonolab.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-probonolab@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-aix.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-aix.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-aix@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-cite-fertile.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-cite-fertile.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-cite-fertile@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-adopte-une-asso.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-adopte-une-asso.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-adopte-une-asso@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-tous-unis-tous-solidaires.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-tous-unis-tous-solidaires.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-tous-unis-tous-solidaires@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-marseille.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-marseille.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-marseille@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-competences-developpements.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-competences-developpements.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-competences-developpements@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-info-jeune.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-info-jeune.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-info-jeune@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-benenova.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-benenova.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-benenova@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-article-1.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-article-1.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-article-1@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-mouvement-associatif.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-mouvement-associatif.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-mouvement-associatif@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-la-ligue-contre-le-cancer.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-la-ligue-contre-le-cancer.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-la-ligue-contre-le-cancer@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-emmaus-connect.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-emmaus-connect.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-emmaus-connect@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-animafac.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-animafac.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-animafac@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-helloasso.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-helloasso.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-helloasso@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-fabrique-solidarite.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-fabrique-solidarite.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-fabrique-solidarite@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-canaux.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-canaux.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-canaux@2x.png 2x
                  `"
            />
          </div>
        </div>
        <div class="badge">
          <div>
            <img
              :src="`${$page.props.assetUrl}/images/partenaires/logo-maison-solidarites.png`"
              :srcset="`
                    ${$page.props.assetUrl}/images/partenaires/logo-maison-solidarites.png 1x,
                    ${$page.props.assetUrl}/images/partenaires/logo-maison-solidarites@2x.png 2x
                  `"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="postcss" scoped>
.badge {
  @screen xs {
    width: 120px;
    height: 120px;
  }
  @screen lg {
    width: 180px;
    height: 180px;
  }
  @apply border rounded-3xl bg-[#F5F5FE];
  > div {
    @apply border-8 border-white rounded-3xl  flex items-center justify-center h-full w-full;
  }
}

#partenaires-logos .badge:nth-child(odd) {
  transform: rotate(-3deg);
}
#partenaires-logos .badge:nth-child(even) {
  transform: rotate(3deg);
}
</style>
