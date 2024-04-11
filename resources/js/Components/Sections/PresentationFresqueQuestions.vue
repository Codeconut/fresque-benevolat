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
        <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center lg:gap-24">
          <h3 class="text-3xl font-bold">{props.title}</h3>
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
  <div class="relative py-20">
    <img
      class="absolute z-0 top-[200px] right-0"
      src="/images/illustrations/dashed-line-3.svg"
      alt=""
    />
    <div class="container relative z-10">
      <div class="overflow-hidden">
        <div
          class="w-0 h-0 border-t-[60px] border-t-transparent border-l-[1284px] border-l-dsfr-yellow-active border-b-[0px] border-b-transparent"
        ></div>
        <div class="p-8 lg:p-16 bg-dsfr-yellow-active">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="">
              <div class="space-y-4">
                <Pane name="atelier" title="Un atelier ludique et participatif">
                  Une expérience collective de 2h30 dans laquelle vous allez avoir une vision
                  globale du bénévolat et comment l’appréhender, tout ça grâce à des jeux et
                  exercices interfactifs !
                </Pane>
                <Pane name="autour" title="(Presque) partout autour de chez vous">
                  Grâce à notre communauté d’animateurs, nous menons des fresques presque partout en
                  France, de Lille à Marseille, de Brest à Strasbourg
                </Pane>
                <Pane name="comprendre" title="Comprendre le bénévolat et passer à l’action">
                  Vous repartirez avec des leviers et premiers pas concrets pour sauter le pas et
                  vous engager en tant que bénévole, dans une association et pour une cause qui vous
                  tiennent à coeur
                </Pane>
              </div>
              <div class="mt-10">
                <Link :href="route('fresques.index')">
                  <Button variant="custom" size="lg" custom-class="border-[#161616] hover:bg-white"
                    >Vous avez des questions</Button
                  >
                </Link>
              </div>
            </div>
            <div class="hidden lg:block relative">
              <img
                class="lg:absolute top-[0px] right-0 h-[375px] w-auto"
                src="/images/illustrations/atelier-ludique-1.png"
                alt=""
              />
              <img
                class="lg:absolute lg:top-[380px] lg:right-0 xl:top-[270px] xl:right-[150px] h-[362px] w-auto"
                src="/images/illustrations/atelier-ludique-2.png"
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
