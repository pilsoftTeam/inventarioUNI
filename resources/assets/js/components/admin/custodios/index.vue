<template>
    <div>


        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: solid 1px lightgrey">
                <form action="" method="post" role="form" @submit.prevent="saveCustodios">
                    <h4 class="text-center">Mantenedor custodios</h4>
                    <div class="form-group">
                        <label for="rut">Rut :</label>
                        <input type="text"
                               v-model="newCustodio.rut"
                               class="form-control"
                               id="rut"
                               placeholder="Escriba aca .....">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre : </label>
                        <input type="text"
                               v-model="newCustodio.nombre"
                               class="form-control"
                               id="nombre"
                               placeholder="Escriba aca .....">
                    </div>
                    <div class="form-group">
                        <label for="unidad">Unidad : </label>
                        <input type="text"
                               v-model="newCustodio.unidad"
                               class="form-control"
                               id="unidad"
                               placeholder="Escriba aca .....">
                    </div>
                    <div class="form-group">
                        <label for="dependencia">Nombre Dependencia :</label>
                        <input type="text"
                               v-model="newCustodio.dependencia"
                               class="form-control"
                               id="dependencia"
                               placeholder="Escriba aca .....">
                    </div>

                    <button type="submit" class="btn btn-block btn-success pull-right">Ingresar</button>
                </form>


            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Rut</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Unidad</th>
                        <th class="text-center">Dependencia</th>
                        <th class="text-center" colspan="2">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">asdas</td>
                        <td class="text-center">asdas</td>
                        <td class="text-center">asdas</td>
                        <td class="text-center">asdas</td>
                        <td class="text-center" colspan="2">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <button class="btn btn-block btn-warning btn-xs" title="Editar este custodio">
                                    <i class="fa fa-pencil"></i>
                                </button>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <button class="btn btn-block btn-danger btn-xs" title="Eliminar este custodio">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</template>
<script>
    export default {
        data () {
            return {
                newCustodio: {
                    rut: '',
                    nombre: '',
                    unidad: '',
                    dependencia: ''
                }
            }
        },
        methods: {
            saveCustodios(){
                console.log(Math.PI)
            }
        }
    }
</script>
