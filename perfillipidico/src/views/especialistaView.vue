<template>
  <div class="container mt-5">
    <!-- Mostrar la cantidad de pacientes con mejor estilo -->
    <div class="d-flex justify-end mb-4">
      <!-- Alinea el botón a la derecha -->
      <v-btn :to="{ path: '/crear/' }" color="blue lighten-1" variant="tonal" class="mx-2">
        INGRESAR PACIENTE
      </v-btn>
    </div>

    <v-card flat>
      <v-card-title class="titulo-especialista">
        <div class="pacientes-info">
          Pacientes: {{ pacientes.length }}
        </div>
      </v-card-title>

      <v-card-title class="titulo-banda sin-fondo">
        <h2>Módulo Especialista</h2>
      </v-card-title>

      <v-card-text>
        <v-text-field
          v-model="search"
          label="Buscar"
          prepend-inner-icon="mdi-magnify"
          variant="outlined"
          hide-details
          single-line
        ></v-text-field>
      </v-card-text>

      <v-data-table
        :headers="headers"
        :items="pacientes"
        :search="search"
        :items-per-page="-1"
        hide-default-footer
      >
        <template v-slot:no-data>
          <div class="text-center">No hay pacientes disponibles</div> <!-- Mensaje personalizado -->
        </template>
        <template v-slot:item.acciones="{ item }">
          <div class="btn-group" role="group" aria-label="Acciones del paciente">
            <v-btn
              :to="{ name: 'detalles', params: { Documento: item.Documento_identidad } }"
              color="blue lighten-1"
              variant="tonal"
              class="mx-2"
            >
              Detalles
            </v-btn>
            <RouterLink :to="{ name: 'actualizar', params: { Documento: item.Documento_identidad } }" class="mx-2">
              <v-btn color="teal lighten-3" variant="tonal">
                Actualizar
              </v-btn>
            </RouterLink>
            <v-btn
              type="button"
              @click="confirmarBorrarPaciente(item.Documento_identidad)"
              color="deep-orange lighten-2"
              variant="tonal"
              class="mx-2"
            >
              Borrar
            </v-btn>
          </div>
        </template>
      </v-data-table>
    </v-card>

    <v-dialog v-model="dialog" persistent width="400">
      <v-card>
        <v-card-title class="headline">Confirmación</v-card-title>
        <v-card-text>
          ¿Está seguro de que desea borrar este paciente?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="borrarPaciente">Sí</v-btn>
          <v-btn color="red darken-1" text @click="dialog = false">No</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <div class="text-muted text-center mt-3">
      BioSoft Technologies
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      search: '',
      headers: [
        { key: 'Documento_identidad', title: 'Documento', align: 'center' },
        { key: 'Nombres', title: 'Nombres', align: 'center' },
        { key: 'Apellidos', title: 'Apellidos', align: 'center' },
        { key: 'acciones', title: 'Acciones', align: 'center' },
      ],
      pacientes: [],
      dialog: false, // Para manejar el estado del diálogo
      pacienteAEliminar: null // Almacena el documento del paciente a eliminar
    };
  },
  created() {
    this.consultarPacientes();
  },
  methods: {
    consultarPacientes() {
      fetch('http://localhost/api/?usuarios=1')
        .then(response => response.json())
        .then((data) => {
          this.pacientes = data.length && typeof data[0].success === 'undefined' ? data : [];
        })
        .catch(console.log);
    },
    confirmarBorrarPaciente(Documento_identidad) {
      this.pacienteAEliminar = Documento_identidad; // Almacena el paciente que se quiere eliminar
      this.dialog = true; // Abre el diálogo de confirmación
    },
    borrarPaciente() {
      fetch('http://localhost/api/?borrar=' + this.pacienteAEliminar)
        .then(response => response.json())
        .then(() => {
          this.consultarPacientes(); // Vuelve a consultar pacientes después de borrar
          this.dialog = false; // Cierra el diálogo
        })
        .catch(console.log);
    }
  }
};
</script>

<style scoped>
/* Estilos para el título del módulo */
.titulo-especialista {
  display: flex; /* Usar flex para alinear el contador */
  justify-content: space-between; /* Espacio entre el título y el contador */
}

/* Estilos para el título sin fondo */
.titulo-banda.sin-fondo {
  color: #000; /* Color del texto */
  padding: 10px; /* Espaciado interno */
  text-align: center; /* Centrado */
  border-radius: 4px; /* Bordes redondeados */
}

/* Estilos para el contador de pacientes */
.pacientes-info {
  font-size: 14px; /* Tamaño de fuente más pequeño */
  font-weight: normal; /* Peso normal */
  color: #00796b; /* Color de texto */
  align-self: center; /* Centra verticalmente */
  margin-left: auto; /* Lleva el contador a la derecha */
}

/* Estilos para los botones */
.btn {
  padding: 10px 15px; /* Relleno en los botones */
  font-size: 14px; /* Tamaño de fuente */
}

.text-muted {
  font-size: 14px; /* Tamaño de fuente reducido */
}
</style>
