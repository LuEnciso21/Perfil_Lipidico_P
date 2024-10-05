<template>
    <div class="container">
      <div class="card">
        <div class="card-header">
          <h1>Página para crear pacientes</h1>
        </div>
        <div class="card-body">
          <form @submit.prevent="agregarPaciente">
            <!-- Campo de Consecutivo removido, ya que se maneja en el backend -->
            <div class="input-group mb-3">
              <span class="input-group-text">Documento identidad</span>
              <input v-model="paciente.Documentoidentidad" type="text" class="form-control" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Nombres</span>
              <input v-model="paciente.Nombres" type="text" class="form-control" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Apellidos</span>
              <input v-model="paciente.Apellidos" type="text" class="form-control" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Edad</span>
              <input v-model="paciente.edad" type="number" class="form-control" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Género</span>
              <select v-model="paciente.genero" class="form-select" required>
                <option value="" disabled>Seleccione Género</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">EPS</span>
              <select v-model="paciente.eps" class="form-select" required>
                <option value="" disabled>Seleccione EPS</option>
                <option value="SURA">SURA</option>
                <option value="Sanitas">Sanitas</option>
                <option value="Compensar">Compensar</option>
                <option value="Nueva EPS">Nueva EPS</option>
              </select>
            </div>
            <!-- Nuevos campos para el perfil lipídico -->
            <div class="input-group mb-3">
              <span class="input-group-text">CHOLT</span>
              <input v-model="paciente.CHOLT" type="number" class="form-control" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">HDL</span>
              <input v-model="paciente.HDL" type="number" class="form-control" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">LDL</span>
              <input v-model="paciente.LDL" type="number" class="form-control" required>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">TRIG</span>
              <input v-model="paciente.TRIG" type="number" class="form-control" required>
            </div>
            <div class="btn-group" role="group">
              <button type="submit" class="btn btn-success">Guardar</button>
              <router-link :to="{ name: 'listar' }" class="btn btn-danger">Cancelar</router-link>
            </div>
          </form>
          <!-- Mensaje de éxito -->
          <div v-if="mensaje" class="alert alert-success mt-3">
            {{ mensaje }}
          </div>
        </div>
        <div class="card-footer text-muted">
          @Ingeniería de Software 2024-2
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        paciente: {
          Documentoidentidad: '',
          Nombres: '',
          Apellidos: '',
          edad: '',
          genero: '',
          eps: '',
          CHOLT: '', // Nueva variable
          HDL: '',   // Nueva variable
          LDL: '',   // Nueva variable
          TRIG: ''   // Nueva variable
        },
        mensaje: '' // Mensaje de éxito
      };
    },
    methods: {
      agregarPaciente() {
        const datosPaciente = {
          Documentoidentidad: this.paciente.Documentoidentidad,
          Nombres: this.paciente.Nombres,
          Apellidos: this.paciente.Apellidos,
          Edad: this.paciente.edad,
          Genero: this.paciente.genero,
          EPS: this.paciente.eps,
          CHOLT: this.paciente.CHOLT, // Nueva variable
          HDL: this.paciente.HDL,       // Nueva variable
          LDL: this.paciente.LDL,       // Nueva variable
          TRIG: this.paciente.TRIG       // Nueva variable
        };
  
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
            this.mensaje = 'Paciente guardado exitosamente';
            this.resetForm();
            // Elimina la redirección a la lista de pacientes
          } else {
            this.mensaje = 'Error al guardar el paciente';
          }
        })
        .catch(error => {
          console.error('Error:', error);
          this.mensaje = 'Error en la conexión';
        });
      },
      resetForm() {
        this.paciente = {
          Documentoidentidad: '',
          Nombres: '',
          Apellidos: '',
          edad: '',
          genero: '',
          eps: '',
          CHOLT: '', // Nueva variable
          HDL: '',   // Nueva variable
          LDL: '',   // Nueva variable
          TRIG: ''   // Nueva variable
        };
      }
    }
  };
  </script>
  
  <style>
  /* Agrega tu estilo aquí si es necesario */
  </style>
  