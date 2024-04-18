<script setup>
import { defineComponent, ref, computed } from 'vue'
import OverlayLayout from '@/Layouts/OverlayLayout.vue'
import {
  RiArrowLeftLine,
  RiShareFill,
  RiFacebookCircleFill,
  RiMessengerFill,
  RiTwitterFill,
  RiLinkedinFill,
  RiWhatsappFill,
} from '@remixicon/vue'

defineProps({
  url: {
    type: String,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
  description: {
    type: String,
    default: '',
  },
  quote: {
    type: String,
    default: '',
  },
  hashtags: {
    type: String,
    default: '',
  },
})

const showOverlay = ref(false)
const facebookRef = ref(null)
const twitterRef = ref(null)
const whatsappRef = ref(null)
const linkedinRef = ref(null)
const messengerRef = ref(null)

const runWorkaround = (index) => {
  let ref = null

  switch (index) {
    case 'facebook':
      ref = facebookRef
      break
    case 'twitter':
      ref = twitterRef
      break
    case 'whatsapp':
      ref = whatsappRef
      break
    case 'linkedin':
      ref = linkedinRef
      break
    case 'messenger':
      ref = messengerRef
      break
  }
  if (ref.value === null) return

  clearInterval(ref.value.popupInterval)
  ref.value.popupWindow = undefined
}
</script>

<template>
  <div>
    <div
      class="flex items-center justify-center h-12 w-12 rounded-full bg-[#FCC63A] cursor-pointer hover:bg-[#FFD976]"
      @click="showOverlay = true"
    >
      <RiShareFill size="24" />
    </div>
    <OverlayLayout v-if="showOverlay" @close="showOverlay = false">
      <div class="container">
        <div class="text-center mb-10">
          <div class="text-lg lg:text-xl">Fresque du Bénévolat</div>
          <div class="text-xl lg:text-[28px] font-bold">
            Partagez cette fresque à l'un de vos proches
          </div>
        </div>
        <div class="max-w-full w-[792px] mx-auto">
          <div class="flex flex-wrap justify-center gap-4">
            <ShareNetwork
              ref="facebookRef"
              network="facebook"
              @open="runWorkaround"
              :url="url"
              :title="title"
              :description="description"
              :quote="quote"
              :hashtags="hashtags"
              class="hover:text-dsfr-blue"
            >
              <RiFacebookCircleFill size="60" class="fill-current" />
            </ShareNetwork>
            <ShareNetwork
              ref="twitterRef"
              network="twitter"
              :url="url"
              :title="title"
              :hashtags="hashtags"
              @open="runWorkaround"
              class="hover:text-dsfr-blue"
            >
              <RiTwitterFill size="60" class="fill-current" />
            </ShareNetwork>
            <ShareNetwork
              ref="whatsappRef"
              network="whatsapp"
              :url="url"
              :title="title"
              :hashtags="hashtags"
              @open="runWorkaround"
              class="hover:text-dsfr-blue"
            >
              <RiWhatsappFill size="60" class="fill-current" />
            </ShareNetwork>
            <ShareNetwork
              ref="messengerRef"
              network="messenger"
              :url="url"
              :title="title"
              :hashtags="hashtags"
              @open="runWorkaround"
              class="hover:text-dsfr-blue"
            >
              <RiMessengerFill size="60" class="fill-current" />
            </ShareNetwork>
            <ShareNetwork
              ref="linkedinRef"
              network="linkedin"
              :title="title"
              :url="url"
              @open="runWorkaround"
              class="hover:text-dsfr-blue"
            >
              <RiLinkedinFill size="60" class="fill-current" />
            </ShareNetwork>
          </div>
        </div>
      </div>
    </OverlayLayout>
  </div>
</template>
