<script setup>
import { defineProps } from 'vue'
import { Tabs, AccordionsGroup, Accordion, Button } from '@/Components/Dsfr'
import { Link, router } from '@inertiajs/vue3'
</script>

<template>
  <div class="py-20">
    <div class="container">
      <h2 class="text-4xl lg:text-5xl font-bold text-center">Vous avez des questions ?</h2>
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
      <div class="text-center mt-8">
        <Link :href="route('fresques.index')">
          <Button
            variant="custom"
            size="lg"
            custom-class="bg-transparent text-dsfr-blue border-blue hover:bg-white"
            >Trouver une fresque <span class="hidden lg:inline">près de chez moi</span></Button
          >
        </Link>
      </div>
    </div>
  </div>
</template>
