<template>
    <div>


        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" style="border-right: solid 1px lightgrey">
                <form action="" method="post" role="form" @submit.prevent="saveCustodios">
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
                        <th class="text-center">#</th>
                        <th class="text-center">Rut</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Unidad</th>
                        <th class="text-center">Dependencia</th>
                        <th class="text-center" colspan="2">Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(custodio, key) in custodios">
                        <td class="text-center">{{key + 1}}</td>
                        <td class="text-center">{{custodio.rut}}</td>
                        <td class="text-center">{{custodio.nombre}}</td>
                        <td class="text-center">{{custodio.unidad}}</td>
                        <td class="text-center">{{custodio.nombreDependencia}}</td>
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
                    dependencia: ''
                },
                custodios: ''
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
            saveCustodios(){
                this.$validator.validateAll().then(() => {
                    axios.post('api/create/custodio', this.newCustodio).then(r => {
                        this.newCustodio.rut = '';
                        this.newCustodio.nombre = '';
                        this.newCustodio.unidad = '';
                        this.newCustodio.dependencia = '';

                        this.getCustodios();
                    }).catch(e => {
                        console.log(e)
                    })
                }).catch(() => {
                });
            },

        },
        computed: {},
    }
</script>
