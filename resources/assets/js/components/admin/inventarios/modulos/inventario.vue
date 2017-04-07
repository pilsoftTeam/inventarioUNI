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
                                        <button class="btn text-center center-block"
                                                data-toggle="modal"
                                                href="#modal-upload"
                                                @click="setUpload(item.rutaImagen,item.fileList, key + 1)"
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
                                                @click="previewRow(item)"
                                                title="Previsualizar esta fila">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger text-center center-block"
                                                @click="deleteRow(key)"
                                                title="Eliminar fila">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <button class="btn btn-danger pull-left" title="Ir hacia atras" @click="back">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        </button>
                        <a class="btn btn-warning pull-left"
                           title="Ver datos de este inventario"
                           data-toggle="modal"
                           href="#modal-id">
                            <i class="fa fa-map-o" aria-hidden="true"></i>
                        </a>

                        <button class="btn btn-info pull-left"
                                title="Imprimir este inventario" @click="getFile">
                            <i class="fa fa-print"></i>
                        </button>


                        <div class="btn-group pull-right">

                            <button type="button"
                                    class="btn btn-primary"
                                    @mouseover="showAddRowMessage = true"
                                    @mouseleave="showAddRowMessage = false"
                                    @click="pushItem"
                                    title="Agregar una fila al final">
                                <span class="animated fadeInLeft" v-if="showAddRowMessage">
                                   <b>Agregar una nueva fila</b>
                                </span>
                                <i class="fa fa-plus"></i>
                            </button>
                            <button type="button"
                                    @mouseover="showEndInventarioMessage = true"
                                    @mouseleave="showEndInventarioMessage = false"
                                    data-toggle="modal" href="#modalEndInventario"
                                    class="btn btn-success animated"
                                    title="Terminar inventario">
                                <span class="animated fadeInLeft" v-if="showEndInventarioMessage">
                                    <b>Guardar cambios</b>
                                </span>
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
        </div>
        <div class="modal fade" id="modalPreview">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Vista previa de la fila</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <ul class="list-group" v-if="preview" style="word-wrap: break-word">
                                    <li class="list-group-item">
                                        <b>Codigo Anterior : </b> <span>{{preview.codigoAnterior}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Codigo Nuevo : </b> <span>{{preview.codigNuevo}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Descripcion : </b> <span>{{preview.descripcion}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Marca : </b> <span>{{preview.marca}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Modelo : </b> <span>{{preview.modelo}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Numero Serie : </b> <span>{{preview.numeroSerie}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Estado : </b> <span>{{preview.estado}}</span>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Comentario : </b> <span>{{preview.comentario}}</span>
                                    </li>
                                </ul>

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
                            <tr v-for="(file, key) in selectedFileList">
                                <td class="text-center" colspan="3">
                                    <img style="margin: 0 auto"
                                         :src="file.dataUrl"
                                         class="img img-bordered img-responsive"
                                         width="50"
                                         height="50">
                                </td>
                                <td class="text-center">
                                    {{file.name}}


                                </td>
                                <td class="text-center" v-if="file.size">
                                    {{sizeOfFile(file.size)}}


                                </td>
                                <td class="text-center" v-if="file.status === 'error'">
                                    <span class="label label-danger">Error en la subida</span>
                                </td>
                                <td class="text-center" v-else>
                                    <span class="label label-success">Subida exitosa</span>
                                </td>
                                <td class="row">
                                    <button class="btn btn-block btn-xs btn-danger" title="Eliminar este archivo"
                                            @click="removeFile(key, file)">
                                        <i class="fa fa-trash-o fa-2x"></i>
                                    </button>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <vue-clip :options="options"
                                  :on-complete="onComplete"
                                  :on-added-file="fileAdded"
                                  :on-sending="onSending">
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
        </div>
        <div class="modal fade" id="modalEndInventario">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Terminar inventario</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-center">¿ Esta seguro que desea terminar este inventario ?</h4>
                                <p class="text-center">
                                    <small>Al hacer click en el boton la pagina se recargara</small>
                                </p>
                                <br>
                                <button class="btn btn-success btn-block" @click="uploadInventario">
                                    Terminar


                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
    import _ from 'lodash'
    import downloader from './../../../modules/fileDownload'
    export default {
        mounted(){
            this.init();
        },
        data () {
            return {
                items: '',
                selectedFileList: [],
                selectedIndex: '',
                selectedRuta: '',


                preview: '',
                options: {
                    url: 'api/file/edit/upload',
                    paramName: 'file',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                },
                showAddRowMessage: false,
                showEndInventarioMessage: false,
                errorOnUpload: false

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
                    this.items = _.forEach(r.data, d => {
                        d.fileList = [];
                        this.selectedRuta = d.rutaArchivo
                    })
                }).catch(e => {
                    console.log(e)
                })
            },
            setUpload(ruta, fileList, index){
                if (ruta) {
                    let o = {
                        ruta: ruta
                    };
                    axios.post('api/get/files', o).then(r => {

                        _.forEach(r.data, f => {
                            let obj = {
                                dataUrl: f.encoded,
                                name: f.basename,
                                size: Math.floor(Math.random() * 90000) + 10000,
                                xhrResponse: {
                                    statusCode: 202
                                }
                            };
                            this.selectedFileList.push(obj)
                        });


                    }).catch(e => {
                        console.log(e)
                    });

                    this.selectedRuta = ruta;


                } else {
                    this.selectedRuta = this.selectedRuta.substring(0, this.selectedRuta.lastIndexOf("/") + 1);
                    this.selectedRuta = this.selectedRuta + index;
                }
                this.selectedFileList = fileList;
                this.selectedIndex = index;
            },
            onSending(file, xhr, formData){
                formData.append('dataInventario', JSON.stringify(this.selectedRuta))
            },
            fileAdded(file){
                this.selectedFileList.push(file);
            },
            removeFile(index, file){
                if (index > -1) {
                    this.selectedFileList.splice(index, 1);
                    let formData = {
                        ruta: this.selectedRuta,
                        filename: file.name
                    };
                    axios.post('api/file/remove/upload', formData).then(r => {
                        console.log(r.data)
                    }).catch(e => {
                        console.log(e)
                    })
                }
            },
            pushItem(){
                const item = {
                    codigoAnterior: '',
                    codigoNuevo: '',
                    descripcion: '',
                    marca: '',
                    modelo: '',
                    numeroSerie: '',
                    fileList: [],
                    rutaArchivo: '',
                    estado: '',
                    comentario: ''
                };
                this.items.push(item);

            },
            deleteRow(index){

                let confirmacion = confirm('Sr. Usuario eliminara una fila del formulario. ¿ Esta seguro de realizar esta acción ?');
                if (confirmacion) {
                    if (index > -1) {
                        this.items.splice(index, 1);
                    }
                }

            },
            sizeOfFile(bytes){
                return filesize(bytes)
            },
            onComplete(file, status, xhr){
                //this.selectedRuta = JSON.parse(xhr.response);
            },
            previewRow(item){
                this.preview = item;
            },
            uploadInventario(){
                let items = JSON.parse(JSON.stringify(this.items));
                let a = _.forEach(items, i => {
                    _.forEach(i.fileList, f => {
                        if (f.xhrResponse.statusCode === 200) {
                            i.rutaArchivo = JSON.parse(f.xhrResponse.response)
                        }
                    });
                    delete i.fileList
                });

                let inventario = {
                    data: this.dataInventario,
                    items: a
                };
                axios.post('api/save/updated/inventario', inventario).then(r => {
                    alert('Inventario actualizado exitosamente. La pagina se recargara ahora');
                    r.status === 201 ? location.reload() : false
                }).catch(e => {
                    $('#modalEndInventario').modal('hide');
                    alert('Hubo un error al intentar guardar el inventario. Por favor asegurese de haber completado todos los campos y haber subido al menos un archivo por cada fila.');
                })
            },
            back(){
                let confirm = window.confirm("Sr Usuario . Al salir del cuestionario , perdera los items y documentos que haya ingresado");
                if (confirm) {
                    let items = JSON.parse(JSON.stringify(this.items));
                    let docs = [];
                    let a = _.forEach(items, i => {
                        _.forEach(i.fileList, f => {
                            if (f.xhrResponse.statusCode === 200) {

                                let obj = {
                                    ruta: f.xhrResponse.response,
                                    filename: f.name
                                };

                                docs.push(obj);
                            }
                        });
                        delete i.fileList
                    });
                    axios.post('api/delete/failed/inventory', docs).then(r => {
                        console.log(r.data)
                    }).catch(e => {
                        console.log()
                    });


                    this.$emit('back')
                }
            },
            getFile(){

                let items = JSON.parse(JSON.stringify(this.items));
                let a = _.forEach(items, i => {
                    delete i.fileList
                });

                let inventario = {
                    data: this.dataInventario,
                    items: a
                };

                axios.post('api/file/get/excel', inventario, {
                    responseType: 'arraybuffer'
                }).then(r => {
                    downloader(r.data, 'inventario.xlsx')
                }).catch(e => {
                    alert('Hay un error')
                })
            }

        }
    }
</script>
