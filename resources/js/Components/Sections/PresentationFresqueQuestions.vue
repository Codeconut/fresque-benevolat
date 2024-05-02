<script setup lang="jsx">
import { Link } from '@inertiajs/vue3'
import Button from '@/Components/Dsfr/Button.vue'
import { RiSubtractLine, RiAddLine } from '@remixicon/vue'
import { ref, defineComponent, computed, Transition } from 'vue'

const selectedPanel = ref('atelier')

const Pane = defineComponent(
  (props, { slots }) => {
    const isSelected = computed(() => {
      return selectedPanel.value === props.name
    })

    const handleClick = () => {
      selectedPanel.value = props.name
    }

    return () => (
      <div
        onClick={handleClick}
        class={[
          'group p-8 lg:hover:scale-105 transition-transform duration-300 ease-in-out',
          isSelected.value ? 'bg-white' : 'bg-[#FDE2B5] cursor-pointer',
        ]}
      >
        <div class="flex lg:flex-row lg:justify-between lg:items-center lg:gap-16">
          <h3 class="text-2xl lg:text-3xl font-bold">{props.title}</h3>
          <div class="mt-4 lg:mt-0">
            {isSelected.value ? <RiSubtractLine size="32" /> : <RiAddLine size="32" />}
          </div>
        </div>

        {isSelected.value && <div class={['text-lg mt-6']}>{slots.default && slots.default()}</div>}
      </div>
    )
  },
  {
    props: ['name', 'title'],
  }
)
</script>

<template>
  <div class="relative py-10 lg:py-20">
    <img
      class="absolute z-0 top-[200px] right-0"
      src="/images/illustrations/dashed-line-3.svg"
      alt=""
    />
    <div class="lg:container relative z-10">
      <div class="overflow-hidden">
        <div class="p-8 lg:p-16 bg-dsfr-yellow-active fresques-clip-path">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-0 lg:pt-12 lg:pb-6">
            <div class="">
              <div class="mb-4 text-[#3A3A3A]">
                Créée et animée avec le ❤️ par
                <a
                  class="underline hover:text-[#161616]"
                  href="https://jeveuxaider.gouv.fr"
                  target="_blank"
                  >JeVeuxAider.gouv.fr</a
                >
              </div>
              <div class="space-y-4">
                <Pane name="atelier" title="Un atelier ludique et participatif">
                  Plus on est de fous, plus on rit ! La fresque rassemble une dizaine de personne
                  dans un environnement ludique propice au partage et à la créativité. Garanti 100%
                  bienveillance et convivialité.
                </Pane>
                <Pane name="autour" title="(Presque) partout autour de chez toi">
                  À l'issue de la fresque tu auras l'occasion de devenir animateur. C'est ce qui
                  permet à la fresque de se déplacer sur tout le territoire pour déclencher partout
                  des envies d'agir.
                </Pane>
                <Pane name="comprendre" title="Une cause qui te tient à coeur">
                  Le bénévolat permet de s'intéresser au monde qui nous entoure, aux autres, pour se
                  sentir utile et déplacer des montagnes. En sortant de la fresque tu sauras par où
                  commencer.
                </Pane>
              </div>
              <div class="mt-10">
                <Link :href="`${route('home')}#faq`">
                  <Button variant="custom" size="lg" custom-class="border-[#161616] hover:bg-white"
                    >Tu as des questions ?</Button
                  >
                </Link>
              </div>
            </div>
            <div class="hidden lg:block relative">
              <img
                class="lg:absolute top-[0px] right-0 h-[340px] w-auto"
                src="/images/illustrations/atelier-ludique-1.png"
                srcset="
                  /images/illustrations/atelier-ludique-1.png 1x,
                  /images/illustrations/atelier-ludique-1.png 2x
                "
                alt=""
              />
              <img
                class="lg:absolute lg:top-[380px] lg:right-0 xl:top-[290px] xl:right-[150px] h-[340px] w-auto"
                src="/images/illustrations/atelier-ludique-2.png"
                srcset="
                  /images/illustrations/atelier-ludique-2.png 1x,
                  /images/illustrations/atelier-ludique-2.png 2x
                "
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
