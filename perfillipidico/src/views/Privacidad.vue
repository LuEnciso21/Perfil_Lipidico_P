<template>
    <v-sheet
      border="md"
      class="pa-6 text-white mx-auto"
      color="#141518"
      max-width="400"
    >
      <h4 class="text-h5 font-weight-bold mb-4">Aviso de Privacidad</h4>
  
      <p class="mb-8">
        Le informamos que su privacidad es de suma importancia para nosotros.
        Todos los datos relacionados con los resultados de los exámenes son
        tratados con el más alto grado de confidencialidad y están protegidos por
        medidas de seguridad adecuadas.
        <br />
        Para acceder a sus resultados, le solicitamos que utilice únicamente su
        número de documento de identidad. Este procedimiento está diseñado para
        garantizar la protección de su información personal y evitar el acceso no
        autorizado a sus datos.
        <br />
        Si está de acuerdo con lo expuesto, le solicitamos que haga clic en el
        botón "Aceptar" para proceder.
      </p>
  
      <v-btn
        class="text-none text-black mb-4"
        color="red-accent-2"
        size="x-large"
        variant="flat"
        block
        @click="acceptPrivacy"
      >
        Aceptar
      </v-btn>
  
      <v-btn
        class="text-none text-black"
        color="red-accent-2"
        size="x-large"
        variant="outlined"
        block
        @click="cancelPrivacy"
      >
        Cancelar
      </v-btn>
    </v-sheet>
  </template>
  
  <script>
  import { useRouter } from 'vue-router';
  
  export default {
    setup() {
      const router = useRouter();
  
      const acceptPrivacy = () => {
        // Redirigir a la vista de buscar
        router.push({ name: 'buscar' });
      };
  
      const cancelPrivacy = () => {
        // Aquí puedes implementar lo que debe suceder si el usuario cancela
        console.log("Usuario canceló la aceptación del aviso de privacidad.");
      };
  
      return {
        acceptPrivacy,
        cancelPrivacy,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Estilos adicionales si es necesario */
  </style>
  