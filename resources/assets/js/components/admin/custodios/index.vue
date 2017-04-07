<template>
    <div>


        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: solid 1px lightgrey">
                <form action="" method="post" role="form" @submit.prevent="saveCustodios('form-1')"
                      data-vv-scope="form-1">
                    <h4 class="text-center">Mantenedor custodios</h4>

                    <div class="form-group">
                        <label for="rut">Rut :</label>

                        <input v-validate="'required|numeric|min:7|max:9'"
                               class="form-control"
                               v-model="newCustodio.rut"
                               :class="{'input': true, 'is-danger': errors.has('rut') }"
                               id="rut"
                               name="rut"
                               type="text"
                               placeholder="Rut sin digito verificador ni guion">
                        <span v-show="errors.has('rut')"
                              class="help danger text-center">
                            {{ errors.first('rut') }}
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre : </label>
                        <input type="text"
                               v-validate="'required|alpha_spaces'"
                               :class="{'input': true, 'is-danger': errors.has('nombre') }"
                               v-model="newCustodio.nombre"
                               class="form-control"
                               id="nombre"
                               name="nombre"
                               placeholder="Escriba aca .....">
                        <span v-show="errors.has('nombre')"
                              class="help danger text-center">
                            {{ errors.first('nombre') }}
                        </span>
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
                               v-model="newCustodio.nombreDependencia"
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
                        <th class="text-center">#</th>
                        <th class="text-center">Rut</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Unidad</th>
                        <th class="text-center">Dependencia</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(custodio, key) in custodios">
                        <td class="text-center">{{key + 1}}</td>
                        <td class="text-center">{{custodio.rut}}</td>
                        <td class="text-center">{{custodio.nombre}}</td>
                        <td class="text-center">{{custodio.unidad}}</td>
                        <td class="text-center">{{custodio.nombreDependencia}}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-block btn-warning btn-xs"
                                        data-toggle="modal" href="#modalEditar"
                                        @click="setCustodio(custodio, 'editar')"
                                        title="Editar este custodio">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-block btn-danger btn-xs"
                                        data-toggle="modal" href="#modalEliminar"
                                        @click="setCustodio(custodio, 'eliminar')"
                                        title="Eliminar este custodio">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="modalEditar">
            <div class="modal-dialog">
                <form action="" method="post" role="form" @submit.prevent="edit('form-2')"
                      data-vv-scope="form-2">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Edicion de custodios</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                                    <div class="form-group">
                                        <label>Rut :</label>
                                        <input v-validate="'required|numeric|min:7|max:9'"
                                               class="form-control"
                                               v-model="editCustodio.rut"
                                               :class="{'input': true, 'is-danger': errors.has('rut') }"
                                               name="editRut"
                                               type="text"
                                               placeholder="Rut sin digito verificador ni guion">
                                        <span v-show="errors.has('rut')"
                                              class="help danger text-center">{{errors.first('rut')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre :</label>
                                        <input type="text"
                                               v-validate="'required|alpha_spaces'"
                                               :class="{'input': true, 'is-danger': errors.has('nombre') }"
                                               v-model="editCustodio.nombre"
                                               class="form-control"
                                               name="editnombre"
                                               placeholder="Escriba aca .....">
                                        <span v-show="errors.has('nombre')" class="help danger text-center">{{errors.first('nombre')}}</span>
                                    </div>
                                    <div class="form-group">
                                        <label>Unidad :</label>
                                        <input type="text"
                                               v-model="editCustodio.unidad"
                                               class="form-control"
                                               placeholder="Escriba aca .....">
                                    </div>
                                    <div class="form-group">
                                        <label>Nombre Dependencia :</label>
                                        <input type="text"
                                               v-model="editCustodio.nombreDependencia"
                                               class="form-control"
                                               placeholder="Escriba aca .....">
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                    data-dismiss="modal"
                                    class="btn btn-default">Cerrar
                            </button>
                            <button type="submit"
                                    class="btn btn-warning">
                                Guardar Cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="modal fade" id="modalEliminar">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Eliminar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <h4 class="text-center">¿ Esta seguro que desea eliminar este custodio ?</h4>
                                <br>
                                <button class="btn btn-block btn-danger" @click="erase">Eliminar</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
</template>
<style>
    .is-danger {
        border-color: rgba(229, 103, 23, 0.8);
        box-shadow: 0 1px 1px rgba(229, 103, 23, 0.075) inset, 0 0 8px rgba(229, 103, 23, 0.6);
        outline: 0 none;
    }

    .danger {
        color: red;
    }
</style>
<script>
    import {Validator} from 'vee-validate';
    export default {
        mounted(){
            this.getCustodios();
        },
        data () {
            return {
                newCustodio: {
                    rut: '',
                    nombre: '',
                    unidad: '',
                    nombreDependencia: ''
                },
                custodios: {},
                editCustodio: {
                    id: '',
                    rut: '',
                    nombre: '',
                    unidad: '',
                    nombreDependencia: ''
                },
                deleteCustodio: '',
            }
        },
        methods: {
            getCustodios(){
                axios.get('api/get/custodios').then(r => {
                    this.custodios = r.data
                }).catch(e => {
                    console.log(e)
                })
            },
            saveCustodios(scope){
                this.$validator.validateAll(scope).then(() => {
                    axios.post('api/create/custodio', this.newCustodio).then(r => {
                        this.newCustodio.rut = '';
                        this.newCustodio.nombre = '';
                        this.newCustodio.unidad = '';
                        this.newCustodio.nombreDependencia = '';
                        this.getCustodios();
                    }).catch(e => {
                        console.log(e)
                    })
                }).catch(() => {
                });
            },
            setCustodio(object, method){
                if (method === 'editar') {
                    this.editCustodio.id = object.id;
                    this.editCustodio.rut = object.rut;
                    this.editCustodio.nombre = object.nombre;
                    this.editCustodio.unidad = object.unidad;
                    this.editCustodio.nombreDependencia = object.nombreDependencia;
                } else if (method === 'eliminar') {
                    this.deleteCustodio = object.id
                } else {

                }
            },

            edit(scope){
                this.$validator.validateAll(scope).then(() => {
                    axios.put('api/edit/custodio', this.editCustodio).then(r => {
                        this.getCustodios();
                        $('#modalEditar').modal('hide')
                    }).catch(e => {
                        console.log(e)
                    });
                });

            },
            erase(){
                axios.delete('api/delete/custodio/' + this.deleteCustodio).then(r => {
                    this.getCustodios();
                    $('#modalEliminar').modal('hide')
                }).catch(e => {
                    console.log(e)
                })
            }

        },
        computed: {},
    }
</script>
