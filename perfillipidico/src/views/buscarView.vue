<template>
    <div class="container">
      <h2 class="text-center">Resultados perfil lipídico</h2>
    
      <!-- Grupo de entrada para buscar paciente por documento de identidad -->
      <div class="input-group">
        <v-text-field
          v-model="documentoIdentidad"
          placeholder="Ingrese el Documento de Identidad"
          class="flex-grow-1"
          :error-messages="errorMessage"
        ></v-text-field>
      </div>
      <v-btn color="blue lighten-1" variant="tonal" @click="buscarPaciente">Buscar</v-btn>
      <div class="card-footer text-muted text-center">
        BioSoft Technologies
      </div>
  
      <!-- Diálogo para mostrar paciente no encontrado -->
      <v-dialog v-model="dialog" max-width="500px">
        <v-card>
          <v-card-title class="text-h5">Búsqueda de resultados</v-card-title>
          <v-card-text>
            <v-icon class="mb-2" color="error" icon="mdi-close-circle-outline" size="128"></v-icon>
            <div class="text-h4 font-weight-bold">Paciente no encontrado</div>
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" @click="dialog = false">Cerrar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
  
      <!-- Mensaje de error si no se encuentra al paciente -->
      <v-sheet v-if="errorMessage" class="text-center">
        <div class="error">{{ errorMessage }}</div>
      </v-sheet>
  
      <!-- Tabla que muestra los detalles del paciente -->
      <v-card v-if="paciente" flat>
        <v-data-table
          :headers="pacienteHeaders"
          :items="[paciente]"
          class="mt-4"
          hide-default-footer
        ></v-data-table>
      </v-card>
  
      <!-- Tabla que muestra el perfil lipídico del paciente -->
      <v-card v-if="lipidico" flat>
        <v-data-table
          :headers="lipidicoHeaders"
          :items="[lipidico]"
          class="mt-4"
          hide-default-footer
        ></v-data-table>
      </v-card>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        documentoIdentidad: '', // Almacena el documento de identidad ingresado
        paciente: null, // Datos del paciente a mostrar
        lipidico: null, // Perfil lipídico del paciente
        errorMessage: '', // Mensaje de error en caso de fallo
        dialog: false, // Control del diálogo de error
        pacienteHeaders: [
          { key: 'Nombres', title: 'Nombres' },
          { key: 'Apellidos', title: 'Apellidos' },
          { key: 'Edad', title: 'Edad' },
          { key: 'Genero', title: 'Género' },
          { key: 'EPS', title: 'EPS' },
        ],
        lipidicoHeaders: [
          { key: 'Documento_identidad', title: 'Documento Identidad' },
          { key: 'CHOLT', title: 'CHOLT' },
          { key: 'HDL', title: 'HDL' },
          { key: 'LDL', title: 'LDL' },
          { key: 'TRIG', title: 'TRIG' },
        ],
      };
    },
    methods: {
      async buscarPaciente() {
        this.errorMessage = ''; // Reinicia el mensaje de error
        this.paciente = null; // Reinicia los datos del paciente
        this.lipidico = null; // Reinicia los datos del perfil lipídico
        this.dialog = false; // Cierra el diálogo si estaba abierto
  
        try {
          // Realiza la solicitud a la API usando fetch
          const response = await fetch(`http://localhost/api/index.php?consultar=${this.documentoIdentidad}`);
          const data = await response.json(); // Convierte la respuesta en JSON
  
          // Verifica si se encontró al paciente
          if (data.success === 0) {
            this.dialog = true; // Mostrar diálogo si el paciente no se encuentra
          } else {
            // Asigna los datos del paciente y el perfil lipídico a las respectivas variables
            this.paciente = data.patient;
            this.lipidico = data.lipidico;
          }
        } catch (error) {
          this.errorMessage = 'Error al buscar el paciente.'; // Mensaje de error en caso de fallo
          console.error(error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilo para centrar el contenedor */
  .container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
  }
  
  /* Espaciado en el encabezado */
  h2 {
    margin-bottom: 20px;
  }
  
  /* Estilo para el grupo de entrada de búsqueda */
  .input-group {
    display: flex;
    align-items: center; /* Alinea los elementos al centro */
    margin-bottom: 20px;
  }
  
  /* Estilo para los mensajes de error */
  .error {
    color: red;
    margin: 10px 0;
  }
  
  /* Estilo de la tabla */
  .table {
    margin-top: 20px;
    border-collapse: collapse;
    width: 100%;
  }
  
  /* Estilo de las celdas de la tabla */
  .table th,
  .table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #007bff; /* Color azul de las líneas */
  }
  
  /* Estilo del encabezado de la tabla */
  .table th {
    background-color: #007bff; /* Fondo azul */
    color: white; /* Texto blanco */
  }
  
  /* Estilo de las filas alternas para un mejor contraste */
  .table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
  }
  
  /* Estilo al pasar el cursor sobre las filas */
  .table-striped tbody tr:hover {
    background-color: #e9ecef;
  }
  </style>
  