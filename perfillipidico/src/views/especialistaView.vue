<template>
    <!-- Contenedor principal del componente -->
    <div class="container mt-5">
        <!-- Tarjeta con sombra para contener el módulo de especialista -->
        <div class="card shadow">
            <!-- Cabecera de la tarjeta con estilo personalizado -->
            <div class="card-header text-center bg-primary text-white">
                <h4>Módulo Especialista</h4> <!-- Título centrado -->
            </div>
            <!-- Cuerpo de la tarjeta que contiene la tabla con los datos de los pacientes -->
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <!-- Cabecera de la tabla -->
                    <thead>
                        <tr>
                            <!-- Definición de los encabezados de las columnas -->
                            <th>Documento</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <!-- Cuerpo de la tabla -->
                    <tbody>
                        <!-- Iteración sobre el array 'pacientes' para mostrar cada paciente -->
                        <tr v-for="paciente in pacientes" :key="paciente.Documento_identidad">
                            <td>{{ paciente.Documento_identidad }}</td> <!-- Mostrar documento -->
                            <td>{{ paciente.Nombres }}</td> <!-- Mostrar nombre -->
                            <td>{{ paciente.Apellidos }}</td> <!-- Mostrar apellidos -->
                            <td>
                                <!-- Grupo de botones con acciones para el paciente -->
                                <div class="btn-group" role="group" aria-label="Acciones del paciente">
                                    <!-- Enlace a la vista de detalles del paciente -->
                                    <RouterLink :to="{ name: 'detalles', params: {Documento: paciente.Documento_identidad } }" class="btn btn-info mx-2">Detalles</RouterLink>
                                    <!-- Enlace a la vista de actualización del paciente -->
                                    <RouterLink :to="{ name: 'actualizar', params: {Documento: paciente.Documento_identidad } }" class="btn btn-success mx-2">Actualizar</RouterLink>
                                    <!-- Botón para borrar el registro del paciente -->
                                    <button type="button" @click="borrarPaciente(paciente.Documento_identidad)" class="btn btn-danger mx-2">Borrar</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pie de la tarjeta con texto centrado -->
            <div class="card-footer text-muted text-center">
                Practica1 Ingeniería de Software
            </div>
        </div>
    </div>
</template>

<script>
export default {
    // Estado local del componente
    data() {
        return {
            pacientes: [] // Inicializa el array de pacientes vacío
        };
    },
    // Hook del ciclo de vida que se ejecuta al crear el componente
    created: function() {
        this.consultarPacientes(); // Llama al método que consulta los pacientes cuando se crea el componente
    },
    methods: {
        // Método para consultar la lista de pacientes desde el servidor
        consultarPacientes() {
            // Realiza una solicitud GET a la API que devuelve los usuarios
            fetch('http://localhost/api/?usuarios=1') 
                .then(response => response.json()) // Parsear la respuesta JSON
                .then((data) => {
                    console.log(data); // Imprime la respuesta en la consola para depuración
                    this.pacientes = []; // Reinicia la lista de pacientes antes de llenarla
                    // Si la respuesta no contiene un campo 'success', asigna los datos a 'pacientes'
                    if (typeof data[0].success === 'undefined') {
                        this.pacientes = data; // Asigna los datos de pacientes
                    }
                })
                .catch(console.log); // Muestra cualquier error en la consola
        },
        // Método para borrar un paciente según su documento
        borrarPaciente(Consecutivo) {
            console.log(Consecutivo); // Imprime el documento del paciente que se va a borrar
            // Realiza una solicitud GET a la API para eliminar el paciente por su documento
            fetch('http://localhost/api/?borrar=' + Consecutivo)
                .then(response => response.json()) // Parsear la respuesta JSON
                .then((data) => {
                    console.log(data); // Imprime la respuesta en la consola
                    window.location.href = 'especialista'; // Redirige a la página 'especialista' tras borrar
                })
                .catch(console.log); // Muestra cualquier error en la consola
        }
    }
}
</script>

<style scoped>
/* Estilos para las tarjetas */
.card {
    border-radius: 15px; /* Bordes redondeados */
}

/* Estilos para los encabezados de la tabla */
.table th {
    background-color: #007bff; /* Fondo azul */
    color: white; /* Texto blanco */
}

/* Estilos para las filas impares de la tabla */
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9; /* Fondo gris claro */
}

/* Estilos para el efecto hover en las filas de la tabla */
.table-striped tbody tr:hover {
    background-color: #e9ecef; /* Fondo gris más oscuro al pasar el mouse */
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
