<template>
  <div>
    <v-carousel
      class="mt-5"
      height="600"
      show-arrows="hover"
      cycle
      hide-delimiter-background
    >
      <v-carousel-item
        v-for="(slide, i) in slides"
        :key="i"
      >
        <v-sheet
          :style="{ backgroundImage: `url(${images[i]})`, backgroundSize: 'cover', backgroundPosition: 'center' }"
          height="100%"
        >
          <div class="d-flex fill-height justify-center align-center">
            <transition name="fade">
              <div 
                class="text-h2 text-center" 
                style="color: white; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"
              >
                {{ slide }}
              </div>
            </transition>
          </div>
        </v-sheet>
      </v-carousel-item>
    </v-carousel>
  </div>
</template>

<script>
export default {
  data () {
    return {
      images: [
        'https://epicrisis.org/wp-content/uploads/2024/09/ciencia-medicina-colegio-medico-medicina-familiar-Jonnathan-Martinez-Lopez-2.jpg', // Imagen para slide 1
        'https://www.mastekhw.com/wp-content/uploads/2021/07/Inteligencia-Artificial-Medicina.jpg', // Imagen para slide 2
        'https://www.medicinaprepagadacolombia.com/assets/img/medicos.webp', // Imagen para slide 3
        'https://www.nosequeestudiar.net/site/assets/files/1695520/por-que-estudiar-la-carrera-de-medicina-medico-estetoscopio.jpg'  // Imagen para slide 4
      ],
      slides: [
        'Cuidamos la salud de tu familia como si fuera la nuestra', // Slide 1
        'Revisa desde cualquier lugar y de manera fácil tus resultados a través del portal del usuario', // Slide 2
        'Nuestros especialistas están siempre conectados, accediendo a tu historial médico.', // Slide 3
        'Atendemos tus necesidades de salud con el mismo cuidado que a los nuestros' // Slide 4
      ],
    }
  },
}
</script>

<style scoped>
.v-carousel-item {
  position: relative;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active en <2.1.8 */ {
  opacity: 0;
}
</style>
