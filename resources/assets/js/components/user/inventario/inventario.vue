<template>
    <div>


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="text-center">Items</h3>
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">


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
                                    <input type="text" v-model="item.codigo.anterior" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="item.codigo.nuevo" class="form-control">
                                </td>
                                <td colspan="2">
                                    <input type="text" v-model="item.detalles.descripcion" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="item.detalles.marca" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="item.detalles.modelo" class="form-control">
                                </td>
                                <td>
                                    <input type="text" v-model="item.detalles.numeroSerie" class="form-control">
                                </td>
                                <td>
                                    <button class="btn text-center center-block"
                                            data-toggle="modal"
                                            href="#modal-upload"
                                            title=" Subir una foto">
                                        <i class="fa fa-picture-o"></i>
                                    </button>
                                </td>
                                <td>
                                    <select class="form-control" v-model="item.estado">
                                        <option value="">Elija</option>
                                        <option value="bueno">Bueno</option>
                                        <option value="malo">Malo</option>
                                        <option value="regular">Regular</option>
                                    </select>
                                </td>
                                <td colspan="2" v-model="item.comentario">
                                    <input type="text" class="form-control">
                                </td>

                                <td>
                                    <button class="btn btn-info text-center center-block"
                                            title="Previsualizar esta fila">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-danger text-center center-block" @click="deleteRow(key)"
                                            title="Eliminar fila">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>

                        <a class="btn btn-warning pull-left" data-toggle="modal" href="#modal-id">
                            <i class="fa fa-adjust"></i>
                        </a>
                        <div class="btn-group pull-right">
                            <button type="button"
                                    class="btn btn-primary"
                                    @click="pushItem"
                                    title="Agregar una fila al final">
                                <i class="fa fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-success" title="Terminar inventario">
                                <i class="fa fa-check"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-id">
            <div class="modal-dialog" style="width: 90%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Datos del inventario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table class="table table-hover" style="font-size: 12px">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Sede</th>
                                        <th class="text-center">Campus</th>
                                        <th class="text-center">Pabellon</th>
                                        <th class="text-center">Piso</th>
                                        <th class="text-center">Codigo Ubicacion</th>
                                        <th class="text-center">Rut Custodio</th>
                                        <th class="text-center">Nombre Custodio</th>
                                        <th class="text-center">Unidad</th>
                                        <th class="text-center">Nombre dependencia</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">{{dataInventario.sede}}</td>
                                        <td class="text-center">{{dataInventario.campus}}</td>
                                        <td class="text-center">{{dataInventario.pabellon}}</td>
                                        <td class="text-center">{{dataInventario.piso}}</td>
                                        <td class="text-center">{{dataInventario.codigoUbicacion}}</td>
                                        <td class="text-center">{{dataInventario.custodio.rut}}</td>
                                        <td class="text-center">{{dataInventario.custodio.nombre}}</td>
                                        <td class="text-center">{{dataInventario.custodio.unidad}}</td>
                                        <td class="text-center">{{dataInventario.custodio.nombreDependencia}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <div class="modal fade" id="modal-upload">
            <div class="modal-dialog">
                <div class="modal-content">


                    <div class="modal-body">
                        <h4 class="text-center">Archivos subidos</h4>
                        <hr>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" colspan="3">Imagen</th>
                                <th class="text-center">Nombre archivo</th>
                                <th class="text-center">Tamaño</th>
                                <th class="text-center">Estado subida</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="file in fileList">
                                <td class="text-center" colspan="3">
                                    <img style="margin: 0 auto"
                                         :src="file.dataUrl"
                                         class="img img-circle img-responsive"
                                         width="50"
                                         height="50">
                                </td>
                                <td class="text-center">
                                    {{file.name}}
                                </td>
                                <td class="text-center" v-if="file.size">
                                    {{sizeOfFile(file.size)}}
                                </td>
                                <td class="text-center">
                                    {{file.status}}
                                </td>
                                <td class="text-center center-block">
                                    <div class="text-center center-block">
                                        <button type="button"
                                                class="btn btn-block btn-warning btn-xs text-center center-block"
                                                title="Renombrar este archivo">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button type="button"
                                                class="btn btn-block btn-danger btn-xs text-center center-block"
                                                title="Eliminar este archivo">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </td>

                            </tr>
                            </tbody>
                        </table>


                    </div>

                    <div class="modal-footer">
                        <vue-clip :options="options" :on-added-file="fileAdded">
                            <template slot="clip-uploader-action" scope="params">
                                <div :class="{'is-dragging': params.dragging}">
                                    <div class="dz-message ">
                                        <h4 class="text-center">Haga click o arrastre aqui para subir archivos</h4>
                                    </div>
                                </div>
                            </template>
                        </vue-clip>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>
</template>
<style>
    .borderLeft {
        border-left: 1px solid lightgrey;
    }

    .borderRight {
        border-right: 1px solid lightgrey;
    }

    .dz-message {
        border: 5px lightgrey dashed;
    }

    .is-dragging {
        animation: pulse 2s ease-out 0s alternate infinite none running;
    }

    @keyframes pulse {
        0% {
            background-color: initial;
        }
        100% {
            background-color: #b6d4ff;
        }
    }

</style>
<script>
    import filesize from 'filesize'
    export default {
        data () {
            return {
                items: [{
                    codigo: {
                        anterior: '',
                        nuevo: ''
                    },
                    detalles: {
                        descripcion: '',
                        marca: '',
                        modelo: '',
                        numeroSerie: ''
                    },
                    foto: '',
                    estado: '',
                    comentario: ''
                }],

                fileList: [],


                options: {
                    url: '/upload',
                    paramName: 'file',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }

            }
        },
        props: {
            dataInventario: {
                type: Object,
                required: true
            }
        },
        methods: {
            pushItem(){
                const item = {
                    codigo: {
                        anterior: '',
                        nuevo: ''
                    },
                    detalles: {
                        descripcion: '',
                        marca: '',
                        modelo: '',
                        numeroSerie: ''
                    },
                    foto: '',
                    estado: '',
                    comentario: ''
                };
                this.items.push(item);

            },
            fileAdded(file){
                this.fileList.push(file)
            },
            deleteRow(index){
                if (index > -1) {
                    this.items.splice(index, 1);
                }
            },

            sizeOfFile(bytes){
                return filesize(bytes)
            }
        },
        computed: {}

    }
</script>
