<template>
  <div class="py-20">
    <div class="container">
      <div class="overflow-hidden">
        <div class="bg-[#77EDA5] text-[#142018] chiffres-clip-path rounded-3xl">
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 p-8 lg:p-24">
            <div class="flex items-center lg:items-start gap-8 lg:flex-col">
              <div>
                <img v-svg-inline src="/images/icons/etoile.svg" alt="" class="text-[#49BC8D]" />
              </div>
              <div>
                <div class="text-5xl lg:text-[80px] font-bold mb-1 lg:mb-4">4,9</div>
                <div class="text-2xl lg:text-[28px] font-bold mb-2 lg:mb-8">sur 5</div>
                <div class="text-lg lg:text-xl">Satisfaction des participants</div>
              </div>
            </div>
            <div class="flex items-center lg:items-start gap-8 lg:flex-col">
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
            <div class="flex items-center lg:items-start gap-8 lg:flex-col">
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
