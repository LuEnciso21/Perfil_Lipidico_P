<template>
    <div class="container mt-5">
      <v-card title="Módulo Especialista" flat>
        <template v-slot:text>
          <v-text-field
            v-model="search"
            label="Search"
            prepend-inner-icon="mdi-magnify"
            variant="outlined"
            hide-details
            single-line
          ></v-text-field>
        </template>
  
        <v-data-table :headers="headers" :items="pacientes" :search="search">
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
              <RouterLink
                :to="{ name: 'actualizar', params: { Documento: item.Documento_identidad } }"
                class="mx-2"
              >
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
  .card {
    border-radius: 15px; /* Bordes redondeados */
  }
  
  /* Estilos para los botones */
  .btn {
    padding: 10px 15px; /* Relleno en los botones */
    font-size: 14px; /* Tamaño de fuente */
  }
  
  /* Estilos para el texto en el pie de página */
  .text-muted {
    font-size: 14px; /* Tamaño de fuente reducido */
  }
  </style>
  