<template>
  <!-- Contenedor principal del formulario para crear pacientes -->
  <div class="container mt-5">
    <!-- Tarjeta con sombra que contiene el formulario -->
    <div class="card shadow">
      <!-- Encabezado de la tarjeta -->
      <div class="card-header text-center bg-primary text-white">
        <h4>Página para crear pacientes</h4> <!-- Título del formulario -->
      </div>
      <!-- Cuerpo de la tarjeta que contiene el formulario -->
      <div class="card-body">
        <!-- El formulario dispara el método 'agregarPaciente' cuando se envía -->
        <form @submit.prevent="agregarPaciente">
          <!-- Campo para Documento identidad, enlazado al modelo 'paciente.Documentoidentidad' -->
          <div class="input-group mb-3">
            <span class="input-group-text">Documento identidad</span>
            <input v-model="paciente.Documentoidentidad" required type="text" class="form-control">
          </div>
          <!-- Campo para Nombres -->
          <div class="input-group mb-3">
            <span class="input-group-text">Nombres</span>
            <input v-model="paciente.Nombres" type="text" class="form-control" required>
          </div>
          <!-- Campo para Apellidos -->
          <div class="input-group mb-3">
            <span class="input-group-text">Apellidos</span>
            <input v-model="paciente.Apellidos" type="text" class="form-control" required>
          </div>
          <!-- Campo para Edad -->
          <div class="input-group mb-3">
            <span class="input-group-text">Edad</span>
            <input v-model="paciente.edad" type="number" class="form-control" required>
          </div>
          <!-- Campo para Género con opciones predefinidas -->
          <div class="input-group mb-3">
            <span class="input-group-text">Género</span>
            <select v-model="paciente.genero" class="form-select" required>
              <option value="" disabled>Seleccione Género</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <!-- Campo para EPS con opciones predefinidas -->
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
          <!-- Campos nuevos para el perfil lipídico -->
          <!-- Campo para CHOLT (colesterol total) -->
          <div class="input-group mb-3">
            <span class="input-group-text">CHOLT</span>
            <input v-model="paciente.CHOLT" type="number" class="form-control" required>
          </div>
          <!-- Campo para HDL -->
          <div class="input-group mb-3">
            <span class="input-group-text">HDL</span>
            <input v-model="paciente.HDL" type="number" class="form-control" required>
          </div>
          <!-- Campo para LDL -->
          <div class="input-group mb-3">
            <span class="input-group-text">LDL</span>
            <input v-model="paciente.LDL" type="number" class="form-control" required>
          </div>
          <!-- Campo para TRIG (triglicéridos) -->
          <div class="input-group mb-3">
            <span class="input-group-text">TRIG</span>
            <input v-model="paciente.TRIG" type="number" class="form-control" required>
          </div>
          <!-- Botones de acción: guardar o cancelar -->
          <div class="btn-group" role="group">
            <button type="submit" class="btn btn-success mx-2">Guardar</button> <!-- Botón para guardar -->
            <router-link :to="{ name: 'home' }" class="btn btn-danger mx-2">Cancelar</router-link> <!-- Botón para cancelar que redirige a 'home' -->
          </div>
        </form>
        <!-- Mensaje de éxito mostrado si 'mensaje' tiene valor -->
        <div v-if="mensaje" class="alert alert-success mt-3">
          {{ mensaje }} <!-- Mensaje dinámico de éxito o error -->
        </div>
      </div>
      <!-- Pie de la tarjeta con un texto centrado -->
      <div class="card-footer text-muted text-center">
        Practica1 Ingeniería de Software
      </div>
    </div>
  </div>
</template>

<script>
export default {
  // Estado del componente
  data() {
    return {
      paciente: {
        Documentoidentidad: '', // Inicializa el documento vacío
        Nombres: '', // Inicializa el campo nombres vacío
        Apellidos: '', // Inicializa el campo apellidos vacío
        edad: '', // Inicializa la edad vacía
        genero: '', // Inicializa el género vacío
        eps: '', // Inicializa la EPS vacía
        CHOLT: '', // Inicializa el colesterol total vacío
        HDL: '', // Inicializa HDL vacío
        LDL: '', // Inicializa LDL vacío
        TRIG: '' // Inicializa triglicéridos vacíos
      },
      mensaje: '' // Inicializa el mensaje vacío para mostrar resultados
    };
  },
  methods: {
    // Método para agregar un nuevo paciente
    agregarPaciente() {
      // Crear un objeto con los datos del paciente a enviar
      const datosPaciente = {
        Documentoidentidad: this.paciente.Documentoidentidad,
        Nombres: this.paciente.Nombres,
        Apellidos: this.paciente.Apellidos,
        Edad: this.paciente.edad,
        Genero: this.paciente.genero,
        EPS: this.paciente.eps,
        CHOLT: this.paciente.CHOLT,
        HDL: this.paciente.HDL,
        LDL: this.paciente.LDL,
        TRIG: this.paciente.TRIG
      };

      // Realizar la solicitud POST al servidor para insertar el paciente
      fetch('http://localhost/api/?insertar=1', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json' // Define el tipo de contenido como JSON
        },
        body: JSON.stringify(datosPaciente) // Convierte el objeto a una cadena JSON
      })
      .then(response => response.json()) // Parsear la respuesta JSON
      .then(data => {
        if (data.success) { // Si la respuesta indica éxito
          this.mensaje = 'Paciente guardado exitosamente'; // Muestra mensaje de éxito
          this.resetForm(); // Resetea el formulario
        } else {
          this.mensaje = 'Error al guardar el paciente'; // Muestra mensaje de error
        }
      })
      .catch(error => { // Si hay un error en la solicitud
        console.error('Error:', error);
        this.mensaje = 'Error en la conexión'; // Muestra mensaje de error de conexión
      });
    },
    // Método para reiniciar el formulario después de guardar
    resetForm() {
      this.paciente = { // Restablece los campos del paciente a valores vacíos
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
      };
    }
  }
};
</script>

<style scoped>
/* Estilos para las tarjetas */
.card {
  border-radius: 15px; /* Bordes redondeados */
}

/* Estilos para los textos de los input groups */
.input-group-text {
  background-color: #007bff; /* Color de fondo azul */
  color: white; /* Texto blanco */
}

/* Estilos para los botones */
.btn {
  padding: 10px 15px; /* Relleno en los botones */
  font-size: 14px; /* Tamaño de fuente */
}

/* Estilos para el pie de página */
.text-muted {
  font-size: 14px; /* Tamaño de fuente reducido */
}

/* Estilos para los mensajes de alerta */
.alert {
  font-size: 14px; /* Tamaño de fuente reducido */
}
</style>
