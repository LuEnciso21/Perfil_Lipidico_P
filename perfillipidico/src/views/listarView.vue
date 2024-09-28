<template>
    <div class="card">
        <div class="card-header">
            LISTAR
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Consecutivo</th>
                        <th>Documento</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Edad</th>
                        <th>Genero</th>
                        <th>EPS</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="paciente in pacientes" v-bind:key="paciente.Consecutivo">
                        <td scope="row">{{ paciente.Consecutivo }}</td>
                        <td>{{ paciente['Documento identidad']}}</td>
                        <td>{{ paciente.Nombres }}</td>
                        <td>{{ paciente.Apellidos }}</td>
                        <td>{{ paciente.Edad}}</td>
                        <td>{{ paciente.Genero}}</td>
                        <td>{{ paciente.EPS}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="">
                                <button type="button" class="btn btn-primary">Editar</button>
                                <button type="button" class="btn btn-primary">Borrar</button>
                                <button type="button" class="btn btn-primary">Agregar</button>
                            </div>
                        </td>
                    </tr>
                  
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            @Practica1 Ingeniería de Software
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            pacientes:[]
        }
    },
    created:function(){
        this.consultarPacientes();
    },
    methods:{
        consultarPacientes(){
            fetch('http://localhost/api/')
            .then(response => response.json())
            .then((data) => {
                console.log(data)
                this.pacientes=[];
                if(typeof data[0].success ==='undefined'){
                    this.pacientes=data;
                }
            


            })
            .catch(console.log)
        }
    }
    
}
</script>