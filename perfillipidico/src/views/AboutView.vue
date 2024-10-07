<template>
    <div>
      <v-row class="justify-center mt-5"> <!-- Agrega 'mt-5' aquí -->
        <v-col v-for="(title, index) in titles" :key="index" cols="auto">
          <v-hover v-slot="{ isHovering, props }">
            <v-card
              class="mx-auto"
              color="grey-lighten-4"
              max-width="550"
              v-bind="props"
            >
              <v-img
                :aspect-ratio="16/9"
                src="https://cdn.vuetifyjs.com/images/cards/kitchen.png"
                cover
              >
                <v-expand-transition>
                  <div
                    v-if="isHovering"
                    class="d-flex transition-fast-in-fast-out bg-orange-darken-2 v-card--reveal text-h2"
                    style="height: 100%"
                  >
                    $14.99
                  </div>
                </v-expand-transition>
              </v-img>
    
              <v-card-text class="pt-6">
                <div class="font-weight-light text-grey text-h6 mb-2">
                  For the perfect meal
                </div>
    
                <h3 class="text-h4 font-weight-light text-orange mb-2">
                  {{ title }} <!-- Cambia aquí el título -->
                </h3>
    
                <div class="font-weight-light text-h6 mb-2">
                  Our Vintage kitchen utensils delight any chef.<br />
                  Made of bamboo by hand
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
          'Misión',    // Primer título
          'Visión',    // Segundo título
          'Política de Calidad' // Tercer título
        ]
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
  </style>
  