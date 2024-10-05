<template>
    <div class="container">
      <h2 class="text-center">Resultados perfil lipídico</h2>
      
      <!-- Grupo de entrada para buscar paciente por documento de identidad -->
      <div class="input-group">
        <input 
          type="text" 
          v-model="documentoIdentidad" 
          class="form-control" 
          placeholder="Ingrese el Documento de Identidad" 
        />
        <button @click="buscarPaciente" class="btn btn-primary">Buscar</button>
      </div>
  
      <!-- Mensaje de error si no se encuentra al paciente -->
      <div v-if="errorMessage" class="error text-center">{{ errorMessage }}</div>
      
      <!-- Tabla que muestra los detalles del paciente -->
      <table v-if="paciente" class="table table-bordered mt-4">
        <thead>
          <tr>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Edad</th>
            <th>Género</th>
            <th>EPS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ paciente.Nombres }}</td>
            <td>{{ paciente.Apellidos }}</td>
            <td>{{ paciente.Edad }}</td>
            <td>{{ paciente.Genero }}</td>
            <td>{{ paciente.EPS }}</td>
          </tr>
        </tbody>
      </table>
  
      <!-- Tabla que muestra el perfil lipídico del paciente -->
      <table v-if="lipidico" class="table table-bordered mt-4">
        <thead>
          <tr>
            <th>Documento Identidad</th>
            <th>CHOLT</th>
            <th>HDL</th>
            <th>LDL</th>
            <th>TRIG</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{ lipidico.Documento_identidad }}</td>
            <td>{{ lipidico.CHOLT }}</td>
            <td>{{ lipidico.HDL }}</td>
            <td>{{ lipidico.LDL }}</td>
            <td>{{ lipidico.TRIG }}</td>
          </tr>
        </tbody>
      </table>
  
      <!-- Pie de la tarjeta -->
      <div class="card-footer text-muted text-center">
        Practica1 Ingeniería de Software
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        documentoIdentidad: '', // Almacena el documento de identidad ingresado
        paciente: null, // Datos del paciente a mostrar
        lipidico: null, // Perfil lipídico del paciente
        errorMessage: '' // Mensaje de error en caso de fallo
      };
    },
    methods: {
      // Método para buscar un paciente en la API basado en el documento de identidad
      async buscarPaciente() {
        this.errorMessage = ''; // Reinicia el mensaje de error
        this.paciente = null; // Reinicia los datos del paciente
        this.lipidico = null; // Reinicia los datos del perfil lipídico
        
        try {
          // Realiza la solicitud a la API usando fetch
          const response = await fetch(`http://localhost/api/index.php?consultar=${this.documentoIdentidad}`);
          const data = await response.json(); // Convierte la respuesta en JSON
  
          // Verifica si se encontró al paciente
          if (data.success === 0) {
            this.errorMessage = 'Paciente no encontrado.'; // Mostrar error si no hay coincidencias
          } else {
            // Asigna los datos del paciente y el perfil lipídico a las respectivas variables
            this.paciente = data.patient;
            this.lipidico = data.lipidico;
          }
        } catch (error) {
          // Captura cualquier error en la solicitud y muestra un mensaje de error
          this.errorMessage = 'Error al buscar el paciente.';
          console.error(error); // Muestra el error en la consola
        }
      }
    }
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
    margin-bottom: 20px;
  }
  
  /* Estilo de los inputs */
  .form-control {
    flex: 1; /* Ocupar el máximo espacio posible */
    padding: 10px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }
  
  /* Estilo del botón de búsqueda */
  .btn {
    margin-left: 10px;
    padding: 10px 15px;
    font-size: 14px;
    border-radius: 5px;
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
  .table th, .table td {
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
  