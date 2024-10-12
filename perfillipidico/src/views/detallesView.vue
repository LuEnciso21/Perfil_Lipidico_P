<template>
    <v-app>
      <v-container>
        <div class="container mt-5">
          <v-card flat>
            <div class="card-header text-center bg-primary text-white">
              <h4>Detalles del Paciente</h4>
            </div>
  
            <div class="card-body">
              <v-text-field
                v-model="search"
                label="Buscar"
                prepend-inner-icon="mdi-magnify"
                variant="outlined"
                hide-details
                single-line
              ></v-text-field>
  
              <v-data-table
                :headers="headers"
                :items="pacientes"
                :search="search"
                class="elevation-1"
                hide-default-footer
              >
                <template v-slot:header="{ props }">
                  <tr>
                    <th
                      v-for="header in props.headers"
                      :key="header.key"
                      class="text-center"
                    >
                      {{ header.title }}
                    </th>
                  </tr>
                </template>
  
                <template v-slot:item="{ item }">
                  <tr>
                    <td class="text-center">{{ item.Documento_identidad }}</td>
                    <td class="text-center">{{ item.CHOLT }}</td>
                    <td class="text-center">{{ item.HDL }}</td>
                    <td class="text-center">{{ item.LDL }}</td>
                    <td class="text-center">{{ item.TRIG }}</td>
                  </tr>
                </template>
              </v-data-table>
  
              <div class="text-center mt-4">
                <RouterLink :to="{ name: 'especialista' }">
                  <v-btn color="deep-purple lighten-5" variant="tonal">
                    Volver
                  </v-btn>
                </RouterLink>
              </div>
            </div>
  
            <!-- Pie de página reducido -->
            <div class="text-muted text-center mt-3">
              BioSoft Technologies
            </div>
          </v-card>
        </div>
      </v-container>
    </v-app>
  </template>
  
  <script>
  export default {
    data() {
      return {
        search: '',
        headers: [
          { key: 'Documento_identidad', title: 'Documento identidad' },
          { key: 'CHOLT', title: 'CHOLT (mg/dL)' },
          { key: 'HDL', title: 'HDL (mg/dL)' },
          { key: 'LDL', title: 'LDL (mg/dL)' },
          { key: 'TRIG', title: 'TRIG (mg/dL)' },
        ],
        pacientes: [],
      };
    },
    created() {
      this.obtenerPaciente();
    },
    methods: {
      obtenerPaciente() {
        fetch('http://localhost/api/?detalles=' + this.$route.params.Documento)
          .then((response) => response.json())
          .then((data) => {
            console.log(data);
            if (data.length) {
              this.pacientes = data;
            } else {
              this.pacientes = [];
            }
          })
          .catch(console.log);
      },
    },
  };
  </script>
  
  <style scoped>
  .card-header {
    background-color: #3f51b5;
    color: white;
  }
  
  .text-center {
    text-align: center;
  }
  
  .text-muted {
    font-size: 14px;
    color: #6c757d;
  }
  </style>
  