<template>
    <div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="text-center">Items</h3>
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center borderRight" colspan="2">
                                        Codigo
                                    </th>
                                    <th class="text-center borderLeft borderRight" colspan="5">
                                        Detalles del bien
                                    </th>
                                    <th class="text-center borderLeft" colspan="4">
                                        Observaciones del bien
                                    </th>
                                    <th class="text-center borderLeft" colspan="2">
                                        Opciones
                                    </th>
                                </tr>
                                </thead>
                                <thead>
                                <tr>
                                    <th class="text-center borderRight">#</th>
                                    <th class="text-center">Anterior</th>
                                    <th class="text-center borderRight">Nuevo</th>
                                    <th class="text-center" colspan="2">Descripcion</th>
                                    <th class="text-center">Marca</th>
                                    <th class="text-center">Modelo</th>
                                    <th class="text-center borderRight">Numero serie</th>
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center borderRight" colspan="2">Comentario</th>
                                    <th class="text-center">Vista previa</th>
                                    <th class="text-center">Eliminar fila</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, key) in items">
                                    <td class="text-center">{{key + 1}}</td>
                                    <td>
                                        <input type="text"
                                               v-model="item.codigoAnterior"
                                               class="form-control input-sm">
                                    </td>
                                    <td>
                                        <input type="text"
                                               v-model="item.codigoNuevo"
                                               class="form-control input-sm">
                                    </td>
                                    <td colspan="2">
                                        <input type="text"
                                               v-model="item.descripcion"
                                               class="form-control input-sm">
                                    </td>
                                    <td>
                                        <input type="text"
                                               v-model="item.marca"
                                               class="form-control input-sm">
                                    </td>
                                    <td>
                                        <input type="text"
                                               v-model="item.modelo"
                                               class="form-control input-sm">
                                    </td>
                                    <td>
                                        <input type="text"
                                               v-model="item.numeroSerie"
                                               class="form-control input-sm">
                                    </td>
                                    <td>
                                        <button class="btn text-center  center-block"
                                                data-toggle="modal"
                                                href="#modal-upload"
                                                title=" Subir una foto">
                                            <i class="fa fa-picture-o"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <select class="form-control input-sm" v-model="item.estado">
                                            <option value="">Elija</option>
                                            <option value="bueno">Bueno</option>
                                            <option value="malo">Malo</option>
                                            <option value="regular">Regular</option>
                                        </select>
                                    </td>
                                    <td colspan="2">
                                        <input type="text"
                                               v-model="item.comentario"
                                               class="form-control input-sm">
                                    </td>
                                    <td>
                                        <button class="btn btn-info text-center center-block"
                                                data-toggle="modal" href="#modalPreview"
                                                title="Previsualizar esta fila">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger text-center center-block"
                                                title="Eliminar fila">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-success pull-right">
                            Guardar Cambios
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
            this.init();
        },
        data () {
            return {
                items: ''
            }
        },
        props: {
            dataInventario: {
                required: true,
                type: Object
            }
        },
        methods: {
            init(){
                axios.get('api/get/items/inventario/' + this.dataInventario.id).then(r => {
                    this.items = r.data;
                }).catch(e => {
                    console.log(e)
                })
            }
        }
    }
</script>
