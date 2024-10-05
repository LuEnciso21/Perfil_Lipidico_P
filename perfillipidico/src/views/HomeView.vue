<template>
  <div class="home">
    <img alt="logo lipidico" src="../assets/images.jpg">
    <HelloWorld msg="LipiTech hace el trabajo duro por ti."/>
  </div>
</template>

<script>
// @ is an alias to /src
import HelloWorld from '@/components/HelloWorld.vue'
export default {
  name: 'HomeView',
  components: {
    HelloWorld
  }
}
</script>