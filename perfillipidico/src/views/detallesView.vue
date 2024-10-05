<template>
    <div class="container mt-5">
        <!-- Tarjeta principal que contiene la tabla de detalles del paciente -->
        <div class="card shadow">
            <!-- Encabezado de la tarjeta con un estilo de fondo azul -->
            <div class="card-header text-center bg-primary text-white">
                <h4>Detalles del Paciente</h4>
            </div>
            
            <!-- Cuerpo de la tarjeta -->
            <div class="card-body">
                <!-- Tabla que muestra los detalles del perfil lipídico del paciente -->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>CHOLT</th>
                            <th>HDL</th>
                            <th>LDL</th>
                            <th>TRIG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <!-- Mostrando los datos del paciente obtenidos -->
                            <td>{{ paciente.Documento_identidad }}</td>
                            <td>{{ paciente.CHOLT }}</td>
                            <td>{{ paciente.HDL }}</td>
                            <td>{{ paciente.LDL }}</td>
                            <td>{{ paciente.TRIG }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Botón para regresar a la vista anterior -->
                <div class="text-center mt-4">
                    <RouterLink :to="{ name: 'especialista' }" class="btn btn-success">
                        Volver
                    </RouterLink>
                </div>
            </div>

            <!-- Pie de la tarjeta con un mensaje de crédito -->
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
            paciente: {} // Objeto que almacena los datos del paciente
        };
    },
    // Hook del ciclo de vida de Vue para cargar los datos cuando el componente es creado
    created: function() {
        this.obtenerPaciente(); // Llamada al método para obtener los detalles del paciente
    },
    methods: {
        // Método que realiza la solicitud a la API para obtener los detalles del paciente
        obtenerPaciente() {
            fetch('http://localhost/api/?detalles=' + this.$route.params.Documento) // Obtiene el documento del parámetro de la ruta
                .then(response => response.json()) // Convierte la respuesta en formato JSON
                .then((data) => {
                    console.log(data); // Imprime los datos en la consola para verificar

                    // Verifica si el objeto obtenido contiene los datos esperados
                    if (data[0]?.Documento_identidad) {
                        this.paciente = data[0]; // Asigna los datos del paciente al objeto 'paciente'
                    } else {
                        this.paciente = {}; // En caso de error, reinicia el objeto 'paciente'
                    }
                })
                .catch(console.log); // Captura cualquier error y lo imprime en la consola
        }
    }
}
</script>

<style scoped>
/* Estilo para redondear las esquinas de la tarjeta */
.card {
    border-radius: 15px;
}

/* Estilo para el encabezado de la tabla con fondo azul */
.table th {
    background-color: #007bff;
    color: white;
}

/* Estilo para alternar el color de las filas de la tabla */
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

/* Estilo para resaltar la fila al pasar el cursor por encima */
.table-striped tbody tr:hover {
    background-color: #e9ecef;
}

/* Estilo del botón de 'Volver' */
.btn {
    padding: 10px 20px;
    font-size: 16px;
}

/* Estilo para el texto en el pie de la tarjeta */
.text-muted {
    font-size: 14px;
}
</style>
