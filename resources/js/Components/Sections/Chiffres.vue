<template>
  <div class="pb-10 lg:py-20">
    <div class="lg:container">
      <div class="overflow-hidden">
        <div class="bg-[#77EDA5] text-[#142018] chiffres-clip-path">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 px-8 py-12 lg:p-24">
            <div class="flex flex-col text-center items-center gap-4 lg:gap-8">
              <div>
                <img
                  v-svg-inline
                  :src="`${$page.props.assetUrl}/images//icons/etoile.svg`"
                  alt=""
                  class="text-[#49BC8D]"
                />
              </div>
              <div>
                <div class="text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">140</div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2 lg:mb-8">participant(e)s</div>
                <div class="text-lg lg:text-xl">depuis 2023</div>
              </div>
            </div>
            <div class="flex flex-col text-center items-center gap-4 lg:gap-8">
              <div>
                <img
                  v-svg-inline
                  :src="`${$page.props.assetUrl}/images//icons/coeur-2.svg`"
                  alt=""
                  class="text-[#49BC8D] focus:outline-none"
                />
              </div>
              <div>
                <div class="text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">12</div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2 lg:mb-8">fresques animées</div>
                <div class="text-lg lg:text-xl">dans plusieurs villes</div>
              </div>
            </div>
            <div class="flex flex-col text-center items-center gap-4 lg:gap-8">
              <div>
                <img
                  v-svg-inline
                  :src="`${$page.props.assetUrl}/images//icons/boussole.svg`"
                  alt=""
                  class="text-[#49BC8D] w-[45px] focus:outline-none"
                />
              </div>
              <div>
                <div class="text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">6</div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2 lg:mb-8">animateur(ice)s</div>
                <div class="text-lg lg:text-xl">formés à la fresque</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
