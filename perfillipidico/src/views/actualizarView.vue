<template>
  <div class="container mt-5">
    <div class="card shadow">
      <!-- Cabecera de la tarjeta, título centrado -->
      <div class="card-header text-center bg-primary text-white">
        <h4>Página para actualizar pacientes</h4>
      </div>
      <div class="card-body">
        <!-- Formulario que dispara la función actualizarPaciente al enviar -->
        <form @submit.prevent="actualizarPaciente">
          <!-- Campo de texto: Documento de identidad (solo lectura) -->
          <div class="input-group mb-3">
            <span class="input-group-text">Documento identidad</span>
            <input v-model="paciente.Documento_identidad" required type="text" class="form-control" readonly>
          </div>
          <!-- Campo de texto: Nombres -->
          <div class="input-group mb-3">
            <span class="input-group-text">Nombres</span>
            <input v-model="paciente.Nombres" type="text" class="form-control" required>
          </div>
          <!-- Campo de texto: Apellidos -->
          <div class="input-group mb-3">
            <span class="input-group-text">Apellidos</span>
            <input v-model="paciente.Apellidos" type="text" class="form-control" required>
          </div>
          <!-- Campo numérico: Edad -->
          <div class="input-group mb-3">
            <span class="input-group-text">Edad</span>
            <input v-model="paciente.Edad" type="number" class="form-control" required>
          </div>
          <!-- Select: Género -->
          <div class="input-group mb-3">
            <span class="input-group-text">Género</span>
            <select v-model="paciente.Genero" class="form-select" required>
              <option value="" disabled>Seleccione Género</option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <!-- Select: EPS -->
          <div class="input-group mb-3">
            <span class="input-group-text">EPS</span>
            <select v-model="paciente.EPS" class="form-select" required>
              <option value="" disabled>Seleccione EPS</option>
              <option value="SURA">SURA</option>
              <option value="Sanitas">Sanitas</option>
              <option value="Compensar">Compensar</option>
              <option value="Nueva EPS">Nueva EPS</option>
            </select>
          </div>

          <!-- Campos del perfil lipídico -->
          <!-- Campo numérico: CHOLT -->
          <div class="input-group mb-3">
            <span class="input-group-text">CHOLT</span>
            <input v-model="lipidico.CHOLT" type="number" class="form-control" required>
          </div>
          <!-- Campo numérico: HDL -->
          <div class="input-group mb-3">
            <span class="input-group-text">HDL</span>
            <input v-model="lipidico.HDL" type="number" class="form-control" required>
          </div>
          <!-- Campo numérico: LDL -->
          <div class="input-group mb-3">
            <span class="input-group-text">LDL</span>
            <input v-model="lipidico.LDL" type="number" class="form-control" required>
          </div>
          <!-- Campo numérico: TRIG -->
          <div class="input-group mb-3">
            <span class="input-group-text">TRIG</span>
            <input v-model="lipidico.TRIG" type="number" class="form-control" required>
          </div>

          <!-- Botones de acción: Guardar y Volver -->
          <div class="btn-group" role="group">
            <button type="submit" class="btn btn-success mx-2">Guardar</button>
            <router-link :to="{ name: 'especialista' }" class="btn btn-primary mx-2">Volver</router-link>
          </div>
        </form>

        <!-- Mensaje de éxito o error, mostrado si existe "mensaje" -->
        <div v-if="mensaje" :class="{'alert-success': mensajeSuccess, 'alert-danger': !mensajeSuccess}" class="alert mt-3">
          {{ mensaje }}
        </div>
      </div>
      <div class="card-footer text-muted text-center">
        Practica1 Ingeniería de Software
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // Datos del paciente inicializados vacíos o con el documento desde la URL
      paciente: {
        Documento_identidad: this.$route.params.Documento, // Parámetro pasado en la URL
        Nombres: '',
        Apellidos: '',
        Edad: '',
        Genero: '',
        EPS: ''
      },
      // Datos del perfil lipídico del paciente
      lipidico: {
        CHOLT: '',
        HDL: '',
        LDL: '',
        TRIG: ''
      },
      mensaje: '', // Mensaje para mostrar éxito o error
      mensajeSuccess: true // Estado para mostrar mensaje de éxito o error
    };
  },
  created() {
    this.obtenerPacienteID(); // Llama a la función cuando el componente se crea
  },
  methods: {
    // Método para obtener los datos del paciente según su documento
    obtenerPacienteID() {
      fetch(`http://localhost/api/index.php?consultar=${this.$route.params.Documento}`)
        .then(response => response.json()) // Convertir respuesta a JSON
        .then((data) => {
          this.paciente = data.patient;  // Asigna los datos del paciente
          this.lipidico = data.lipidico;  // Asigna los datos del perfil lipídico
        })
        .catch(console.log); // En caso de error, lo registra en la consola
    },
    // Método para actualizar los datos del paciente en la API
    actualizarPaciente() {
      // Datos a enviar a la API, organizados por paciente y perfil lipídico
      const datosPaciente = {
        patient: {
          Documento_identidad: this.paciente.Documento_identidad,
          Nombres: this.paciente.Nombres,
          Apellidos: this.paciente.Apellidos,
          Edad: this.paciente.Edad,
          Genero: this.paciente.Genero,
          EPS: this.paciente.EPS
        },
        lipidico: {
          Documento_identidad: this.paciente.Documento_identidad,
          CHOLT: this.lipidico.CHOLT,
          HDL: this.lipidico.HDL,
          LDL: this.lipidico.LDL,
          TRIG: this.lipidico.TRIG
        }
      };

      // Realiza la solicitud POST a la API para actualizar los datos
      fetch(`http://localhost/api/?actualizar=${this.paciente.Documento_identidad}`, {
        method: 'POST', // Método POST
        headers: {
          'Content-Type': 'application/json' // Tipo de contenido JSON
        },
        body: JSON.stringify(datosPaciente) // Convierte el objeto a JSON
      })
      .then(response => response.json()) // Convertir respuesta a JSON
      .then(data => {
        // Si la respuesta es exitosa, muestra el mensaje de éxito
        if (data.success) {
          this.mensajeSuccess = true;
          this.mensaje = 'Paciente guardado exitosamente';
          this.resetForm(); // Limpia el formulario
        } else {
          // Si no, muestra mensaje de error
          this.mensajeSuccess = false;
          this.mensaje = 'Error al guardar el paciente';
        }
      })
      .catch(error => {
        console.error('Error:', error); 
        this.mensajeSuccess = false;
        this.mensaje = 'Paciente  Actualizado'; 
      });
    },
    // Método para resetear los formularios después de guardar
    resetForm() {
      // Reinicia los campos del paciente y perfil lipídico
      this.paciente = {
        Documento_identidad: this.$route.params.Documento, // Vuelve a establecer el documento
        Nombres: '',
        Apellidos: '',
        Edad: '',
        Genero: '',
        EPS: ''
      };
      this.lipidico = {
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
/* Estilo de la tarjeta */
.card {
  border-radius: 15px; /* Bordes redondeados */
}

/* Estilo del texto dentro de los input groups */
.input-group-text {
  background-color: #007bff; /* Fondo azul */
  color: white; /* Texto blanco */
}

/* Estilo de los botones */
.btn {
  padding: 10px 15px; /* Espaciado interno */
  font-size: 14px; /* Tamaño del texto */
}

/* Estilo del texto al pie de la tarjeta */
.text-muted {
  font-size: 14px; /* Tamaño del texto */
}

/* Estilo de las alertas de éxito y error */
.alert {
  font-size: 14px; /* Tamaño del texto */
}

/* Alerta de éxito (color verde claro) */
.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}

/* Alerta de error (color rojo claro) */
.alert-danger {
  color: #721c24;
  background-color: #f8d7da;
  border-color: #f5c6cb;
}
</style>
