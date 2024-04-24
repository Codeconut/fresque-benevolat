<script setup>
import { Tabs, AccordionsGroup, Accordion, Button } from '@/Components/Dsfr'
import { Link, router } from '@inertiajs/vue3'
</script>

<template>
  <div id="faq" class="py-10 lg:py-20">
    <div class="container">
      <div class="text-center">
        <h2 class="relative inline text-3xl lg:text-5xl font-bold">
          Vous avez des questions ?
          <img
            v-svg-inline
            src="/images/icons/gimmick.svg"
            alt=""
            class="text-[#FCD17B] absolute w-[45px] lg:w-[65px] h-auto top-[-30px] right-[-40px] lg:top-[-25px] lg:right-[-60px] focus:outline-none"
          />
        </h2>
      </div>

      <Tabs
        name="Catégories de faq"
        :tabs="[
          { key: 'participants', content: 'Participants' },
          { key: 'animateurs', content: 'Animateurs' },
          { key: 'organisations', content: 'Organisations' },
        ]"
        class="mt-14"
      >
        <template #tab-participants>
          <AccordionsGroup>
            <Accordion>
              <template #title> C’est gratuit ? </template>
              <div class="mb-6">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, magnam. Ad
                  officiis fugiat optio facere debitis corrupti dignissimos assumenda animi! Illum
                  quas repellendus unde possimus iste natus adipisci suscipit delectus!
                </p>
              </div>
            </Accordion>
            <Accordion>
              <template #title>
                Je me suis inscrit mais je ne peux plus participer, comment je fais ?
              </template>
              <div class="mb-6">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, magnam. Ad
                  officiis fugiat optio facere debitis corrupti dignissimos assumenda animi! Illum
                  quas repellendus unde possimus iste natus adipisci suscipit delectus!
                </p>
              </div>
            </Accordion>
            <Accordion>
              <template #title>
                J’ai déjà participé à une fresque du bénévolat et je souhaite devenir animateur
              </template>
              <div class="mb-6">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, magnam. Ad
                  officiis fugiat optio facere debitis corrupti dignissimos assumenda animi! Illum
                  quas repellendus unde possimus iste natus adipisci suscipit delectus!
                </p>
              </div>
            </Accordion>
          </AccordionsGroup>
        </template>

        <template #tab-animateurs>
          <AccordionsGroup>
            <Accordion>
              <template #title> Question 1 ? </template>
              <div class="mb-6">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, magnam. Ad
                  officiis fugiat optio facere debitis corrupti dignissimos assumenda animi! Illum
                  quas repellendus unde possimus iste natus adipisci suscipit delectus!
                </p>
              </div>
            </Accordion>
          </AccordionsGroup>
        </template>
        <template #tab-organisations>
          <AccordionsGroup>
            <Accordion>
              <template #title> Question 1 ? </template>
              <div class="mb-6">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis, magnam. Ad
                  officiis fugiat optio facere debitis corrupti dignissimos assumenda animi! Illum
                  quas repellendus unde possimus iste natus adipisci suscipit delectus!
                </p>
              </div>
            </Accordion>
          </AccordionsGroup>
        </template>
      </Tabs>
      <div class="relative text-center mt-8">
        <Link :href="route('fresques.index')">
          <Button
            variant="custom"
            size="lg"
            custom-class="bg-transparent text-dsfr-blue border-dsfr-blue hover:bg-white"
            >Trouver une fresque <span class="hidden lg:inline">près de chez moi</span></Button
          >
        </Link>
        <img
          v-svg-inline
          src="/images/icons/arbre.svg"
          alt=""
          class="absolute right-[300px] bottom-[-40px] text-white focus:outline-none"
        />
      </div>
    </div>
  </div>
</template>
