<template>
  <div class="container mt-5">
    <div class="card shadow form-container">
      <div class="card-header text-center bg-primary text-white">
        <h4>Página para actualizar pacientes</h4>
      </div>
      <div class="card-body">
        <v-fade-transition hide-on-leave>
          <v-card
            v-if="mensaje"
            append-icon="$close"
            class="mx-auto success-dialog"
            elevation="10"
            max-width="500"
            title="Resultado de la Actualización"
          >
            <template v-slot:append>
              <v-btn icon="$close" variant="text" @click="mensaje = ''"></v-btn>
            </template>

            <v-divider></v-divider>

            <div class="py-12 text-center">
              <v-icon
                class="mb-6"
                color="success" 
                icon="mdi-check-circle-outline"
                size="128"
              ></v-icon>

              <div class="text-h4 font-weight-bold">Actualizado exitosamente</div> <!-- Texto fijo -->
            </div>

            <v-divider></v-divider>

            <div class="pa-4 text-end">
              <v-btn
                class="text-none"
                color="medium-emphasis"
                min-width="92"
                variant="outlined"
                rounded
                @click="mensaje = ''"
              >
                Cerrar
              </v-btn>
            </div>
          </v-card>
        </v-fade-transition>

        <form @submit.prevent="actualizarPaciente">
          <v-text-field
            v-model="paciente.Documento_identidad"
            label="Documento identidad"
            required
            readonly
          ></v-text-field>

          <v-text-field
            v-model="paciente.Nombres"
            label="Nombres"
            required
          ></v-text-field>

          <v-text-field
            v-model="paciente.Apellidos"
            label="Apellidos"
            required
          ></v-text-field>

          <v-text-field
            v-model="paciente.Edad"
            label="Edad"
            type="number"
            required
          ></v-text-field>

          <v-select
            v-model="paciente.Genero"
            :items="['Masculino', 'Femenino', 'Otro']"
            label="Género"
            required
          ></v-select>

          <v-select
            v-model="paciente.EPS"
            :items="['SURA', 'Sanitas', 'Compensar', 'Nueva EPS']"
            label="EPS"
            required
          ></v-select>

          <v-text-field
            v-model="lipidico.CHOLT"
            label="CHOLT"
            type="number"
            required
          ></v-text-field>

          <v-text-field
            v-model="lipidico.HDL"
            label="HDL"
            type="number"
            required
          ></v-text-field>

          <v-text-field
            v-model="lipidico.LDL"
            label="LDL"
            type="number"
            required
          ></v-text-field>

          <v-text-field
            v-model="lipidico.TRIG"
            label="TRIG"
            type="number"
            required
          ></v-text-field>

          <div class="btn-group" role="group">
            <v-btn color="blue lighten-1" variant="tonal" class="mx-2" type="submit">Guardar</v-btn>
            <router-link :to="{ name: 'especialista' }">
              <v-btn color="red lighten-1" variant="tonal" class="mx-2">Volver</v-btn>
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

<script>
export default {
  data() {
    return {
      paciente: {
        Documento_identidad: this.$route.params.Documento,
        Nombres: '',
        Apellidos: '',
        Edad: '',
        Genero: '',
        EPS: ''
      },
      lipidico: {
        CHOLT: '',
        HDL: '',
        LDL: '',
        TRIG: ''
      },
      mensaje: '',
      mensajeSuccess: true
    };
  },
  created() {
    this.obtenerPacienteID();
  },
  methods: {
    obtenerPacienteID() {
      fetch(`http://localhost/api/index.php?consultar=${this.$route.params.Documento}`)
        .then(response => response.json())
        .then((data) => {
          this.paciente = data.patient;
          this.lipidico = data.lipidico;
        })
        .catch(console.log);
    },
    actualizarPaciente() {
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

      fetch(`http://localhost/api/?actualizar=${this.paciente.Documento_identidad}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(datosPaciente)
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          this.mensajeSuccess = true;
          this.mensaje = 'Paciente guardado exitosamente';
          this.resetForm();
        } else {
          this.mensajeSuccess = false;
          this.mensaje = 'Error al guardar el paciente';
        }
      })
      .catch(error => {
        console.error('Error:', error);
        this.mensajeSuccess = false;
        this.mensaje = 'Error en la conexión';
      });
    },
    resetForm() {
      this.paciente = {
        Documento_identidad: this.$route.params.Documento,
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
.form-container {
  max-width: 600px; /* Limita el ancho del formulario */
  margin: 0 auto; /* Centra el formulario horizontalmente */
}

.card {
  border-radius: 15px; /* Bordes redondeados */
}

.success-dialog {
  margin-top: 20px; 
}

.text-muted {
  font-size: 14px; /* Tamaño del texto */
}
</style>
