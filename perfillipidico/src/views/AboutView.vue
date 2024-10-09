<template>
  <div>
    <v-row class="justify-center mt-5">
      <v-col v-for="(title, index) in titles" :key="index" cols="auto">
        <v-hover v-slot="{ isHovering, props }">
          <v-card
            class="mx-auto"
            color="grey lighten-4"
            max-width="400"
            v-bind="props"
            :style="{ position: 'relative', overflow: 'hidden' }"
          >
            <!-- Imagen de fondo solo en la parte superior -->
            <v-img
              :src="getBackgroundImage(index)"
              height="200"
              width="100%"
              cover
            >
              <v-expand-transition>
                <div
                  v-if="isHovering"
                  class="d-flex transition-fast-in-fast-out bg-blue-lighten-4 v-card--reveal"
                  style="height: 100%; align-items: center; justify-content: center;"
                >
                  <!-- Resúmenes de títulos con texto más pequeño -->
                  <span v-if="title === 'Visión'" class="text-h6">Líder en soluciones tecnológicas</span>
                  <span v-if="title === 'Misión'" class="text-h6">Exámenes rápidos y accesibles</span>
                  <span v-if="title === 'Política de Calidad'" class="text-h6">Cumplimiento y mejora continua</span>
                </div>
              </v-expand-transition>
            </v-img>

            <v-card-text class="pt-6">
              <!-- Cambiado el color del título a blue-grey lighten-5 -->
              <h3 class="text-h4 font-weight-light text-blue-grey lighten-5 mb-2">
                {{ title }}
              </h3>

              <!-- Descripciones dinámicas -->
              <div v-if="title === 'Visión'" class="font-weight-light text-h6 mb-2">
                Ser una empresa líder en el desarrollo de soluciones tecnológicas innovadoras 
                y accesibles para la salud, mejorando la calidad de vida de las personas a 
                través de herramientas avanzadas para la detección, diagnóstico y monitoreo de 
                enfermedades crónicas, con un enfoque en la prevención y tratamiento de 
                condiciones como el perfil lipídico, contribuyendo a un futuro más saludable.
              </div>

              <div v-if="title === 'Misión'" class="font-weight-light text-h6 mb-2">
                Ofrecer soluciones tecnológicas de alta calidad para el cuidado de la salud 
                que permitan a pacientes y profesionales médicos realizar exámenes de perfil 
                lipídico de manera rápida, precisa y accesible. Nos comprometemos a utilizar 
                tecnología de vanguardia y una red de distribución eficiente para garantizar 
                que nuestras herramientas lleguen a cada rincón donde se necesiten, mejorando 
                la detección temprana y la gestión de enfermedades cardiovasculares y metabólicas.
              </div>

              <div v-if="title === 'Política de Calidad'" class="font-weight-light text-h6 mb-2">
                Garantizamos la integralidad en la prestación de los Servicios de Salud, el 
                cumplimiento de los estándares de calidad establecidos en la Resolución de 
                Acreditación, la calidez en la atención y el profesionalismo del talento humano, 
                mejorando continuamente nuestros procesos con el fin de satisfacer las necesidades 
                y expectativas de nuestros clientes y usuarios.
              </div>
            </v-card-text>
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      titles: [
        'Misión',
        'Visión',
        'Política de Calidad'
      ],
      backgroundImages: [
        'https://clinicavirgenguadalupe.com/wp-content/uploads/2024/02/medico-de-clinica-hispana.jpg', // Imagen para Misión
        'https://www.newmedicaleconomics.es/wp-content/uploads/2022/07/medicine-doctor-hand-working-with-modern-computer-interface-1-scaled.jpg', // Imagen para Visión
        'https://www.meditips.com/wp-content/uploads/2022/05/medicina.jpg' // Imagen para Política de Calidad
      ]
    }
  },
  methods: {
    getBackgroundImage(index) {
      return this.backgroundImages[index];
    }
  }
}
</script>

<style>
.v-card--reveal {
  align-items: center;
  bottom: 0;
  justify-content: center;
  opacity: 0.9;
  position: absolute;
  width: 100%;
}

/* Cambiado a blue-lighten-4 */
.bg-blue-lighten-4 {
  background-color: #e3f2fd; /* Color correspondiente a blue-lighten-4 en Vuetify */
}

/* Color del texto de los títulos */
.text-blue-grey-lighten-5 {
  color: #eceff1; /* Color correspondiente a blue-grey lighten-5 en Vuetify */
}
</style>
