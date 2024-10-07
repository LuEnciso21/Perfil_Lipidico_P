<template>
  <div id="app">
      <!-- Componente que aparecerá en la parte superior -->
      <HelloWorld />

      <!-- Componente de vista -->
      <router-view />
  </div>
</template>

<script>
import HelloWorld from './components/HelloWorld.vue';

export default {
  components: {
      HelloWorld
  }
}
</script>

<style>
/* Estilos generales */
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
