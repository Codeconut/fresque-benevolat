<template>
  <div class="pb-10 lg:py-20">
    <div class="lg:container">
      <div class="overflow-hidden">
        <div class="bg-[#77EDA5] text-[#142018] chiffres-clip-path">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 px-8 py-12 lg:p-24">
            <div class="flex flex-col text-center items-center lg:items-start gap-4 lg:gap-8">
              <div>
                <img v-svg-inline src="/images/icons/etoile.svg" alt="" class="text-[#49BC8D]" />
              </div>
              <div>
                <div class="text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">4,9</div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2 lg:mb-8">sur 5</div>
                <div class="text-lg lg:text-xl">Satisfaction des participants</div>
              </div>
            </div>
            <div class="flex flex-col text-center items-center lg:items-start gap-4 lg:gap-8">
              <div>
                <img
                  v-svg-inline
                  src="/images/icons/coeur-2.svg"
                  alt=""
                  class="text-[#49BC8D] focus:outline-none"
                />
              </div>
              <div>
                <div class="text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">1 000</div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2 lg:mb-8">participants</div>
                <div class="text-lg lg:text-xl">Depuis 2023</div>
              </div>
            </div>
            <div class="flex flex-col text-center items-center lg:items-start gap-4 lg:gap-8">
              <div>
                <img
                  v-svg-inline
                  src="/images/icons/boussole.svg"
                  alt=""
                  class="text-[#49BC8D] w-[45px] focus:outline-none"
                />
              </div>
              <div>
                <div class="text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">3 000</div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2 lg:mb-8">
                  heures de bénévolat
                </div>
                <div class="text-lg lg:text-xl">Générées grâce aux fresques</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
