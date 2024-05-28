<script setup>
import { Tabs, AccordionsGroup, Accordion, Button } from '@/Components/Dsfr'
import { Link, router } from '@inertiajs/vue3'
</script>

<template>
  <div id="faq" class="py-10 lg:py-20">
    <div class="">
      <div class="text-center">
        <h2 class="relative inline text-4xl lg:text-5xl font-bold">
          Tu as des <br class="lg:hidden" />
          questions ?
          <inline-svg
            :src="`${$page.props.assetUrl}/images/icons/gimmick.svg`"
            alt=""
            class="text-[#FCD17B] absolute w-[45px] lg:w-[65px] h-auto top-[-15px] right-[-42px] lg:top-[-25px] lg:right-[-60px] focus:outline-none"
          />
        </h2>
      </div>

      <Tabs
        name="Catégories de faq"
        :tabs="[
          { key: 'participants', content: 'Participants' },
          { key: 'animateurs', content: 'Animateurs' },
        ]"
        class="mt-14"
      >
        <template #tab-participants>
          <AccordionsGroup>
            <Accordion>
              <template #title> C’est gratuit ? </template>
              <div class="mb-6">
                <p>
                  La fresque du bénévolat est un atelier 100% gratuit, créé et animé avec le ❤️ par
                  JeVeuxAider.gouv.fr. Il suffit de t’inscrire à la fresque de ton choix via ce
                  site, et d’y participer le jour J.
                </p>
              </div>
            </Accordion>
            <Accordion>
              <template #title>
                Je me suis inscrit, mais je ne peux plus participer, comment je fais ?
              </template>
              <div class="mb-6">
                <p>
                  Lors de ton inscription, tu as reçu un email de validation. Sur cet email, tu as
                  la possibilité de mettre à jour ton inscription, et d’annuler ta participation.
                </p>
              </div>
            </Accordion>
            <Accordion>
              <template #title>
                J’ai déjà participé à une fresque du bénévolat et souhaite devenir animateur
              </template>
              <div class="mb-6">
                <p>
                  Merveilleuse nouvelle ! Pour devenir animateur d’une fresque du bénévolat, il faut
                  participer à une formation. L’ensemble des formations disponibles sont accessibles
                  sur
                  <a
                    target="_blank"
                    href="https://www.jeveuxaider.gouv.fr/missions-benevolat?structure.name=JeVeuxAider.gouv.fr&search="
                    >ce lien</a
                  >. Si aucune n’est ouverte, retente ta chance dans quelques semaines 🙂
                </p>
              </div>
            </Accordion>
            <Accordion>
              <template #title> Pourquoi ça fonctionne ? </template>
              <div class="mb-6">
                <p>
                  Cette fresque du bénévolat est géniale, parce qu’elle est composée de plein de
                  micro actions, à la portée de toutes et de tous. Elle déjoue les peurs et ancre
                  les engagements dans le présent. Or on le sait, pour passer à l’action, il vaut
                  mieux viser un changement de « proche en proche », à petite échelle, petits pas
                  après petits pas.
                </p>
              </div>
            </Accordion>
          </AccordionsGroup>
        </template>

        <template #tab-animateurs>
          <AccordionsGroup>
            <Accordion>
              <template #title> Comment devenir animateur ? </template>
              <div class="mb-6">
                <p>
                  La 1ère étape pour devenir animateur d’une fresque du bénévolat, c’est d’en avoir
                  vécu une. Ensuite, une formation est nécessaire. L’ensemble des formations
                  disponibles sont accessibles sur
                  <a
                    target="_blank"
                    href="https://www.jeveuxaider.gouv.fr/missions-benevolat?structure.name=JeVeuxAider.gouv.fr&search="
                    >ce lien</a
                  >. Si aucune n’est ouverte, retente ta chance dans quelques semaines 🙂
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
            >Trouver une fresque <span class="hidden lg:inline">à deux pas</span></Button
          >
        </Link>
        <inline-svg
          :src="`${$page.props.assetUrl}/images/icons/arbre.svg`"
          alt=""
          class="absolute right-[300px] bottom-[-40px] text-white focus:outline-none"
        />
      </div>
    </div>
  </div>
</template>
