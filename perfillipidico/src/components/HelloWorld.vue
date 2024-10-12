<template>
  <v-footer class="bg-blue-lighten-3 pt-0 pb-2 ma-0">
    <v-img
      :width="100"  
      :height="100" 
      aspect-ratio="10" 
      cover
      src="https://i.pinimg.com/564x/60/72/a5/6072a5d3397dd6ae6b2c70ebdf689e27.jpg"
      class="mr-2" 
    ></v-img>
    <v-row justify="center" no-gutters>
      <router-link
        v-for="link in links"
        :key="link.name"
        :to="link.path"
        class="mx-2"
      >
        <v-btn color="white" rounded="xl" variant="text">
          {{ link.name }}
        </v-btn>
      </router-link>
    </v-row>
  </v-footer>
</template>

<script>
export default {
  data: () => ({
    links: [
      { name: 'Inicio', path: '/' },
      { name: 'Nosotros', path: '/nosotros' }, 
      { name: 'Especialista', path: '/Login' },
      { name: 'Consultar resultados', path: '/buscar' },
    ],
  }),
}
</script>