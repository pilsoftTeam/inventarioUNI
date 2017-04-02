<template>
    <div>
        <h4 class="text-center">Datos del inventario</h4>
        <hr>

        <table class="table table-hover table-responsive">
            <thead>
            <tr class="text-center">
                <th class="text-center">Sede</th>
                <th class="text-center">Campus</th>
                <th class="text-center">Pabellon</th>
                <th class="text-center">Piso</th>
                <th class="text-center">Codigo ubicación</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center">{{names.sede}}</td>
                <td class="text-center">{{names.campus}}</td>
                <td class="text-center">{{dataInventario.pabellon}}</td>
                <td class="text-center">{{dataInventario.piso}}</td>
                <td class="text-center">{{dataInventario.codigoUbicacion}}</td>
            </tr>
            </tbody>
        </table>
        <hr>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <label class="col-sm-2 control-label">Rut del custodio:</label>
                <div class="col-sm-9">
                    <input type="number" placeholder="Escriba aca" v-model="rutCustodio" class="form-control">
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-xs btn-default" @click="buscarCustodio" title="Buscar rut del custodio">
                        <i class="fa fa-search fa-2x"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div v-if="custodio">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h4 class="text-center">Datos del custodio</h4>
                        <hr>
                        <table class="table table-hover">
                            <thead>
                            <tr class="text-center">
                                <th class="text-center"><b>Rut</b></th>
                                <th class="text-center"><b>Nombre</b></th>
                                <th class="text-center"><b>Unidad</b></th>
                                <th class="text-center"><b>Nombre Dependencia</b></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">{{custodio[0].rut}}</td>
                                <td class="text-center">{{custodio[0].nombre}}</td>
                                <td class="text-center">{{custodio[0].unidad}}</td>
                                <td class="text-center">{{custodio[0].nombreDependencia}}</td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <h4 class="text-center">Imagen Layout</h4>
                            <hr>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <vue-clip :options="options"
                                          :on-added-file="fileAdded"
                                          :on-sending="onSending">
                                    <template slot="clip-uploader-action" scope="params">
                                        <div :class="{'is-dragging': params.dragging}">
                                            <div class="dz-message ">
                                                <h4 class="text-center">Haga click o arrastre aqui para subir
                                                    archivos</h4>
                                            </div>
                                        </div>
                                    </template>
                                </vue-clip>

                                <br>
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Nombre archivo</th>
                                        <th class="text-center">Tamaño</th>
                                        <th class="text-center">Estado subida</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">
                                            {{fileList.name}}


                                        </td>
                                        <td class="text-center" v-if="fileList.size">
                                            {{sizeOfFile(fileList.size)}}


                                        </td>
                                        <td class="text-center" v-if="fileList.status === 'error'">
                                            <span class="label label-danger">Error en la subida</span>
                                        </td>
                                        <td class="text-center" v-else-if="fileList.status === 'success'">
                                            <span class="label label-success">Subida exitosa</span>
                                        </td>
                                        <td v-else>

                                        </td>
                                        <!--<td class="row">
                                            <button class="btn btn-block btn-xs btn-danger"
                                                    title="Eliminar este archivo"
                                                    @click="removeFile(key, file)">
                                                <i class="fa fa-trash-o fa-2x"></i>
                                            </button>
                                        </td>-->

                                    </tr>
                                    </tbody>
                                </table>


                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                <img class="img-responsive img"
                                     width="150"
                                     height="150"
                                     style="margin:0 auto" :src="fileList.dataUrl" alt="">
                                <h6 class="text-center">La imagen se mostrara en un formato 150X150.</h6>
                            </div>
                        </div>

                        <br>
                        <hr>
                        <button class="btn btn-block btn-success" @click="empezar">Empezar el inventario</button>
                    </div>
                </div>
                <div v-else>
                    <p class="text-center" v-if="beforeCall">
                        <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                    </p>
                    <div class="alert alert-danger fade in" v-if="wrongCall">
                        <strong>Error : </strong> El rut <b>{{rutCustodio}}</b> no existe en la base de datos. Intente
                        nuevamente


                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<style>
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
                items: {
                    campus: '',
                },
                custodio: '',
                rutCustodio: '',
                beforeCall: false,
                wrongCall: false,


                options: {
                    url: 'api/file/layout/upload',
                    paramName: 'file',
                    headers: {
                        'X-CSRF-TOKEN': window.Laravel.csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                },
                fileList: {},
            }
        },
        props: {
            dataInventario: {
                required: true,
                type: Object
            },
            names: {
                required: true,
                type: Object
            }
        },
        methods: {


            onSending(file, xhr, formData){
                let dataInventario = this.dataInventario;
                formData.append('dataInventario', JSON.stringify(dataInventario))
            },
            fileAdded(file){
                this.fileList = file
            },
            sizeOfFile(bytes){
                return filesize(bytes)
            },
            buscarCustodio(){
                this.beforeCall = true;
                if (this.rutCustodio) {
                    axios.get('api/get/custodio/' + this.rutCustodio).then(r => {
                        if (r.data.length == 0) {
                            this.custodio = '';
                            this.wrongCall = true;
                            this.beforeCall = false;
                            setTimeout(function () {
                                this.wrongCall = false
                            }.bind(this), 3500)
                        } else {
                            this.beforeCall = false;
                            this.custodio = r.data
                        }
                    }).catch(e => {
                        console.log(e)
                    })
                }


            },
            empezar(){

                let obj = {
                    custodio: this.custodio,
                    file: this.fileList
                };

                this.$emit('custodio', obj)
            }
        }
    }
</script>
