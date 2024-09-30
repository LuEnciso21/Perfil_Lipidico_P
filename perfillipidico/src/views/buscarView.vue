<template>
    <div>
      <h2>Resultados perfil lipídico</h2>
      <input 
        type="text" 
        v-model="documentoIdentidad" 
        placeholder="Ingrese el Documento de Identidad" 
      />
      <button @click="buscarPaciente">Buscar</button>
      
      <div v-if="errorMessage" class="error">{{ errorMessage }}</div>
      
      <table v-if="paciente" border="1">
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
  
      <table v-if="lipidico" border="1" style="margin-top: 20px;">
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
            <td>{{ lipidico['Documento identidad'] }}</td>
            <td>{{ lipidico.CHOLT }}</td>
            <td>{{ lipidico.HDL }}</td>
            <td>{{ lipidico.LDL }}</td>
            <td>{{ lipidico.TRIG }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        documentoIdentidad: '',
        paciente: null,
        lipidico: null,
        errorMessage: ''
      };
    },
    methods: {
      async buscarPaciente() {
        this.errorMessage = ''; // Resetear el mensaje de error
        this.paciente = null; // Resetear los datos del paciente
        this.lipidico = null; // Resetear los datos del perfil lipídico
        
        try {
          const response = await fetch(`http://localhost/api/index.php?consultar=${this.documentoIdentidad}`);
          const data = await response.json();
  
          if (data.success === 0) {
            this.errorMessage = 'Paciente no encontrado.';
          } else {
            this.paciente = data.patient; // Asignar la información del paciente
            this.lipidico = data.lipidico; // Asignar la información del perfil lipídico
          }
        } catch (error) {
          this.errorMessage = 'Error al buscar el paciente.';
          console.error(error);
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .error {
    color: red;
  }
  </style>
  