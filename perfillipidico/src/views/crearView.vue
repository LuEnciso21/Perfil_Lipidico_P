<template>
    <div class="container mt-5">
      <div class="card shadow form-container">
        <div class="card-header text-center bg-primary text-white">
          <h4>Página para crear pacientes</h4>
        </div>
        <div class="card-body">
          <!-- Mensaje de éxito -->
          <v-fade-transition hide-on-leave>
            <v-card
              v-if="dialog"
              append-icon="$close"
              class="mx-auto success-dialog"
              elevation="10"
              max-width="500"
              title="Ingreso Paciente"
            >
              <template v-slot:append>
                <v-btn icon="$close" variant="text" @click="dialog = false"></v-btn>
              </template>
  
              <v-divider></v-divider>
  
              <div class="py-12 text-center">
                <v-icon
                  class="mb-6"
                  color="success"
                  icon="mdi-check-circle-outline"
                  size="128"
                ></v-icon>
  
                <div class="text-h4 font-weight-bold">Paciente guardado exitosamente</div>
              </div>
  
              <v-divider></v-divider>
  
              <div class="pa-4 text-end">
                <v-btn
                  class="text-none"
                  color="medium-emphasis"
                  min-width="92"
                  variant="outlined"
                  rounded
                  @click="dialog = false"
                >
                  Cerrar
                </v-btn>
              </div>
            </v-card>
          </v-fade-transition>
  
          <form @submit.prevent="agregarPaciente">
            <!-- Documento identidad -->
            <v-text-field
              v-model="paciente.Documentoidentidad"
              label="Documento identidad"
              type="number"
              required
            ></v-text-field>
  
            <!-- Nombres -->
            <v-text-field
              v-model="paciente.Nombres"
              label="Nombres"
              required
            ></v-text-field>
  
            <!-- Apellidos -->
            <v-text-field
              v-model="paciente.Apellidos"
              label="Apellidos"
              required
            ></v-text-field>
  
            <!-- Edad -->
            <v-text-field
              v-model="paciente.edad"
              label="Edad"
              type="number"
              required
            ></v-text-field>
  
            <!-- Género -->
            <v-select
              v-model="paciente.genero"
              :items="generoItems"
              label="Género"
              required
            ></v-select>
  
            <!-- EPS -->
            <v-select
              v-model="paciente.eps"
              :items="epsItems"
              label="EPS"
              required
            ></v-select>
  
            <!-- CHOLT -->
            <v-text-field
              v-model="paciente.CHOLT"
              label="CHOLT (mg/dL)"
              type="number"
              required
            ></v-text-field>
  
            <!-- HDL -->
            <v-text-field
              v-model="paciente.HDL"
              label="HDL (mg/dL)"
              type="number"
              required
            ></v-text-field>
  
            <!-- LDL -->
            <v-text-field
              v-model="paciente.LDL"
              label="LDL (mg/dL)"
              type="number"
              required
            ></v-text-field>
  
            <!-- TRIG -->
            <v-text-field
              v-model="paciente.TRIG"
              label="TRIG (mg/dL)"
              type="number"
              required
            ></v-text-field>
  
            <!-- Botones -->
            <div class="btn-group" role="group">
              <v-btn color="blue lighten-1" variant="tonal" class="mx-2" type="submit">Guardar</v-btn>
              <router-link :to="{ name: 'especialista' }">
                <v-btn color="red lighten-1" variant="tonal" class="mx-2">Cancelar</v-btn>
              </router-link>
            </div>
          </form>
        </div>
        <div class="card-footer text-muted text-center">
          BioSoft Technologies
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  // Estado inicial del paciente y mensaje
  const paciente = ref({
    Documentoidentidad: '',
    Nombres: '',
    Apellidos: '',
    edad: '',
    genero: '',
    eps: '',
    CHOLT: '',
    HDL: '',
    LDL: '',
    TRIG: ''
  })
  
  const mensaje = ref('')
  const dialog = ref(false) // Cambiado a false por defecto
  
  // Opciones para los select
  const generoItems = ['Masculino', 'Femenino', 'Otro']
  const epsItems = ['SURA', 'Sanitas', 'Compensar', 'Nueva EPS']
  
  // Método para agregar el paciente a la API
  const agregarPaciente = () => {
    const datosPaciente = {
      Documentoidentidad: paciente.value.Documentoidentidad,
      Nombres: paciente.value.Nombres,
      Apellidos: paciente.value.Apellidos,
      Edad: paciente.value.edad,
      Genero: paciente.value.genero,
      EPS: paciente.value.eps,
      CHOLT: paciente.value.CHOLT,
      HDL: paciente.value.HDL,
      LDL: paciente.value.LDL,
      TRIG: paciente.value.TRIG
    }
  
    fetch('http://localhost/api/?insertar=1', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datosPaciente)
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          mensaje.value = 'Paciente guardado exitosamente'
          dialog.value = true // Abrir el diálogo
          resetForm()
        } else {
          mensaje.value = 'Error al guardar el paciente'
        }
      })
      .catch(error => {
        console.error('Error:', error)
        mensaje.value = 'Error en la conexión'
      })
  }
  
  // Método para reiniciar el formulario
  const resetForm = () => {
    paciente.value = {
      Documentoidentidad: '',
      Nombres: '',
      Apellidos: '',
      edad: '',
      genero: '',
      eps: '',
      CHOLT: '',
      HDL: '',
      LDL: '',
      TRIG: ''
    }
  }
  </script>
  
  <style scoped>
  /* Ajustes de estilo */
  .form-container {
    max-width: 600px; /* Esto limita el ancho del formulario */
    margin: 0 auto; /* Centra el formulario horizontalmente */
  }
  
  .card {
    border-radius: 15px;
  }
  
  .success-dialog {
    margin-top: 20px; 
  }
  
  .btn {
    padding: 10px 15px;
  }
  
  .text-muted {
    font-size: 14px;
  }
  
  .alert {
    font-size: 14px;
  }
  </style>
  