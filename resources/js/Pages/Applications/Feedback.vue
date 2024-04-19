<script setup>
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import { useForm } from '@inertiajs/vue3'
import { Input, Button, FormElement, Textarea } from '@/Components/Dsfr'
import StarRating from 'vue-star-rating'

const props = defineProps({
  token: {
    type: String,
    required: true,
  },
  fresque: {
    type: Object,
    required: true,
  },
  application: {
    type: Object,
    required: true,
  },
  feedback: {
    type: Object,
  },
})

const form = useForm({
  rating: props.feedback?.rating || 3,
  questions: {
    donner_envie_lancer_benevolat: props.feedback?.questions?.donner_envie_lancer_benevolat || null,
    comment_as_tu_trouve_les_animations:
      props.feedback?.questions?.comment_as_tu_trouve_les_animations || null,
    comment_as_tu_trouve_les_animateurs:
      props.feedback?.questions?.comment_as_tu_trouve_les_animateurs || null,
    as_tu_trouve_le_lieu_approprié:
      props.feedback?.questions?.as_tu_trouve_le_lieu_approprié || null,
    quest_ce_que_tu_as_adore: props.feedback?.questions?.quest_ce_que_tu_as_adore || null,
    quest_ce_qui_ta_manque: props.feedback?.questions?.quest_ce_qui_ta_manque || null,
    quaurais_tu_enleve_a_cette_fresque:
      props.feedback?.questions?.quaurais_tu_enleve_a_cette_fresque || null,
    quaurais_tu_fais_differement: props.feedback?.questions?.quaurais_tu_fais_differement || null,
    serais_tu_interesse_pour_devenir_animateur:
      props.feedback?.questions?.serais_tu_interesse_pour_devenir_animateur || null,
  },
})

const onSubmit = () => {
  console.log('onSubmit', form)
  form.submit(
    'post',
    route('fresques.applications.feedback.updateOrCreate', {
      fresqueApplication: props.token,
    }),
    {
      //preserveScroll: false,
      onStart: () => {
        form.processing = true
      },
      onError: () => {
        console.log('onError', form.errors)
      },
      onSuccess: () => {
        console.log('onSuccess', form)
      },
      onFinish: () => {
        form.processing = false
      },
    }
  )
}
</script>

<template>
  <OverlayLayout head-title="Feedback" :redirect-url="route('fresques.show', { fresque })">
    <div class="container">
      <div class="max-w-full w-[792px] mx-auto text-center mb-10">
        <div class="text-lg lg:text-xl mb-2">
          Un grand merci pour ta participation à la Fresque du Bénévolat !
        </div>
        <div class="text-xl lg:text-[28px] leading-10 font-bold">
          À {{ fresque.place.city }}, le {{ $dayjs(fresque.date).format('DD MMMM YYYY') }} de
          {{ fresque.schedules }}
        </div>
      </div>
      <div class="max-w-full w-[792px] mx-auto">
        <div class="p-8 lg:p-12 bg-white shadow-lg">
          <div class="text-center mb-8">
            <h2 class="text-[32px] font-bold mb-6">
              On a besoin de toi {{ application.first_name }} !
            </h2>
            <div class="text-lg lg:text-xl lg:px-12">
              Nous avons été ravi(e)s d'animer cette expérience participative avec toi. 🤗
            </div>
          </div>

          <form @submit.prevent="onSubmit" class="">
            <div class="grid grid-cols-1 gap-8 mb-12">
              <FormElement
                name="first_name"
                label="Est-ce que cette Fresque t'a plue ?"
                required
                :error="form.errors.rating"
              >
                <StarRating v-model:rating="form.rating" star-size="35" />
              </FormElement>
              <FormElement
                name="comment_as_tu_trouve_les_animations"
                label="Comment as-tu trouvé les différentes animations / ateliers ?"
                required
                :error="form.errors?.questions?.comment_as_tu_trouve_les_animations"
              >
                <StarRating
                  v-model:rating="form.questions.comment_as_tu_trouve_les_animations"
                  star-size="35"
                />
              </FormElement>
              <FormElement
                name="comment_as_tu_trouve_les_animateurs"
                label="Comment as-tu trouvé les différentes animations / ateliers ?"
                required
                :error="form.errors?.questions?.comment_as_tu_trouve_les_animateurs"
              >
                <StarRating
                  v-model:rating="form.questions.comment_as_tu_trouve_les_animateurs"
                  star-size="35"
                />
              </FormElement>
              <FormElement
                name="as_tu_trouve_le_lieu_approprié"
                label="As-tu trouvé le lieu approprié pour faire la Fresque ?"
                required
                :error="form.errors?.questions?.as_tu_trouve_le_lieu_approprié"
              >
                <StarRating
                  v-model:rating="form.questions.as_tu_trouve_le_lieu_approprié"
                  star-size="35"
                />
              </FormElement>
              <FormElement
                name="questions.quest_ce_que_tu_as_adore"
                label="Est-ce que cela t'a donné envie de te lancer dans le bénévolat ?"
                :error="form.errors?.questions?.quest_ce_que_tu_as_adore"
              >
                <Textarea
                  name="quest_ce_que_tu_as_adore"
                  v-model="form.questions.quest_ce_que_tu_as_adore"
                  placeholder="Placeholder"
                  :error="!!form.errors?.questions?.quest_ce_que_tu_as_adore"
                />
              </FormElement>
              <FormElement
                name="questions.quest_ce_qui_ta_manque"
                label="Qu'est-ce qui t'a manqué dans cette Fresque ?"
                :error="form.errors?.questions?.quest_ce_qui_ta_manque"
              >
                <Textarea
                  name="quest_ce_qui_ta_manque"
                  v-model="form.questions.quest_ce_qui_ta_manque"
                  placeholder="Placeholder"
                  :error="!!form.errors?.questions?.quest_ce_qui_ta_manque"
                />
              </FormElement>
              <FormElement
                name="questions.quaurais_tu_enleve_a_cette_fresque"
                label="Qu'aurais-tu enlevé dans cette Fresque ?"
                :error="form.errors?.questions?.quaurais_tu_enleve_a_cette_fresque"
              >
                <Textarea
                  name="quaurais_tu_enleve_a_cette_fresque"
                  v-model="form.questions.quaurais_tu_enleve_a_cette_fresque"
                  placeholder="Placeholder"
                  :error="!!form.errors?.questions?.quaurais_tu_enleve_a_cette_fresque"
                />
              </FormElement>
              <FormElement
                name="questions.quaurais_tu_fais_differement"
                label="Qu'aurais-tu fait différemment dans cette Fresque ?"
                :error="form.errors?.questions?.quaurais_tu_fais_differement"
              >
                <Textarea
                  name="quaurais_tu_fais_differement"
                  v-model="form.questions.quaurais_tu_fais_differement"
                  placeholder="Placeholder"
                  :error="!!form.errors?.questions?.quaurais_tu_fais_differement"
                />
              </FormElement>
            </div>

            <Button type="submit" size="lg" full>Enregistrer</Button>
          </form>
        </div>
      </div>
    </div>
  </OverlayLayout>
</template>
