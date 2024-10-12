<template>
  <!-- Componente que renderiza una hoja (v-sheet) centrada horizontalmente con un ancho de 400px y margen superior de 100px -->
  <v-sheet class="mx-auto" width="400" style="margin-top: 100px;">
    <!-- Título centrado -->
    <h2 class="text-center">Autenticación</h2>

    <!-- Formulario de autenticación, se referencia como "form" y está vinculado al modelo "valid" para validación -->
    <v-form ref="form" v-model="valid">
      <!-- Campo de texto para el usuario, con reglas de validación y es requerido -->
      <v-text-field
        v-model="usuario"
        :rules="usuarioRules"
        label="Usuario"
        required
      ></v-text-field>

      <!-- Campo de texto para la contraseña, oculta el texto mediante el atributo type="password" -->
      <v-text-field
        v-model="contrasena"
        :rules="contrasenaRules"
        label="Contraseña"
        type="password"
        required
      ></v-text-field>

      <!-- Muestra un mensaje de error centrado si las credenciales son incorrectas -->
      <v-sheet v-if="errorMessage" class="text-center">
        <div class="error">{{ errorMessage }}</div>
      </v-sheet>

      <!-- Botones para Ingresar y Cancelar, ambos alineados verticalmente -->
      <div class="d-flex flex-column">
        <!-- Botón "Ingresar" con color y estilo específico, se ejecuta la función iniciarSesion() al hacer clic -->
        <v-btn
          type="button"
          class="mt-4"
          color="teal lighten-3"
          block
          variant="tonal"
          @click="iniciarSesion"
        >
          Ingresar
        </v-btn>

        <!-- Botón "Cancelar" con color y estilo específico, ejecuta la función cancelar() al hacer clic -->
        <v-btn
          type="button"
          class="mt-4"
          color="deep-orange lighten-2"
          block
          variant="tonal"
          @click="cancelar"
        >
          Cancelar
        </v-btn>
      </div>
    </v-form>
  </v-sheet>
</template>

<script>
export default {
  data() {
    return {
      usuario: '', // Almacena el valor del campo usuario
      contrasena: '', // Almacena el valor del campo contraseña
      errorMessage: '', // Almacena el mensaje de error si las credenciales son incorrectas
      valid: false, // Controla si el formulario es válido
      // Reglas de validación para el campo usuario
      usuarioRules: [
        v => !!v || 'El usuario es requerido',
      ],
      // Reglas de validación para el campo contraseña
      contrasenaRules: [
        v => !!v || 'La contraseña es requerida',
      ],
    };
  },
  
  methods: {
    // Función que maneja el inicio de sesión
    iniciarSesion() {
      this.errorMessage = ''; // Reinicia el mensaje de error

      const usuarioValido = 'angelower.santana'; // Usuario válido predefinido
      const contrasenaValida = '123'; // Contraseña válida predefinida

      // Verifica si el usuario y la contraseña coinciden con los valores válidos
      if (this.usuario === usuarioValido && this.contrasena === contrasenaValida) {
        this.$router.push({ name: 'especialista' }); // Redirige a la ruta "especialista" si las credenciales son correctas
      } else {
        this.errorMessage = 'Credenciales incorrectas'; // Muestra un mensaje de error si las credenciales no son correctas
      }
    },

    // Función para cancelar la acción y redirigir al home
    cancelar() {
      this.usuario = ''; // Limpia el campo usuario
      this.contrasena = ''; // Limpia el campo contraseña
      this.errorMessage = ''; // Limpia el mensaje de error
      this.$router.push({ path: '/' }); // Redirige a la ruta home
    },
  },
};
</script>

<style scoped>
/* Estilo para los mensajes de error */
.error {
  color: red;
  margin: 10px 0;
}
</style>
