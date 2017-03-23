<template>
    <div>
        <div v-if="init">
            <div class="col-xs-18 col-sm-4 col-md-4 col-lg-4">


                <div class="panel panel-default">
                    <div class="panel-body">
                        <h4 class="text-center">Información de ubicación</h4>
                        <hr>
                        <div class="form-group">
                            <label class="control-label">Sede</label>
                            <select class="form-control" @change="setCampus" v-model="data.sede">
                                <option value=""> -- Seleccione --</option>
                                <option v-for="item in sedes" :value="item.id" :key="item.id">
                                    {{item.sede}}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Campus</label>
                            <select class="form-control" v-model="data.campus" @change="setPabellon">
                                <option value=""> -- Seleccione --</option>
                                <option v-for="item in campus.get_campus" :key="item.id" :value="item.id">
                                    {{campus.sede}} - {{item.campus}}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pabellon</label>
                            <select class="form-control" v-model="data.pabellon">
                                <option value=""> -- Seleccione --</option>
                                <option :value="key" v-for="(key, item) in pabellones.pabellones">
                                    {{ pabellones.campus }} -- Pabellon {{ key }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Piso</label>
                            <select class="form-control" v-model="data.piso">
                                <option value=""> -- Seleccione --</option>
                                <option v-for="piso in 10" :value="piso" :key="piso.id">
                                    {{piso}}
                                </option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="control-label">Codigo de ubicacion</label>
                            <input type="text"
                                   v-model="data.codigoUbicacion"
                                   class="form-control"
                                   placeholder="Escriba aca">
                        </div>


                        <button class="btn btn-block btn-info" @click="next" :disabled="!showInfoComponent">
                            Siguiente
                        </button>
                    </div>
                </div>


            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="panel panel-default" v-if="showComponent">
                    <div class="panel-body">
                        <info :dataInventario="data" :names="names" @custodio="datosCustodio"></info>
                    </div>
                </div>
                <div v-else>
                    <h3 class="text-center" style="margin-top: 25%">Por favor llene los items</h3>
                </div>
            </div>
        </div>
        <div v-if="inventario">
            <inventario :dataInventario="data"></inventario>
        </div>


    </div>
</template>

<script>
    import _ from 'lodash'
    import Info from './dataInfo/index.vue'
    import Inventario from './inventario/inventario.vue'
    export default {
        mounted(){
            this.getDatos();
        },
        data () {
            return {
                sedes: '',
                campus: '',
                pabellones: '',

                data: {
                    sede: '',
                    campus: '',
                    pabellon: '',
                    piso: '',
                    codigoUbicacion: '',
                    custodio: ''
                },
                names: {
                    sede: '',
                    campus: ''
                },
                selectedCampus: '',
                showComponent: false,
                init: true,
                inventario: false

            }
        },
        methods: {

            getDatos(){
                axios.get('api/get/sedes/informacion').then(r => {
                    this.sedes = r.data;
                }).catch(e => {
                    console.log(e)
                })
            },

            setCampus(){
                this.data.campus = '';
                this.data.pabellon = '';
                this.data.piso = '';
                this.data.codigoUbicacion = '';
                this.data.custodio = '';


                if (this.data.sede) {
                    this.campus = _.find(this.sedes, c => {
                        return c.id == this.data.sede;
                    });
                } else {
                    console.log('THERE IS NOT A OBJECT')
                }
            },
            setPabellon(){
                this.data.pabellon = '';
                this.data.piso = '';
                this.data.codigoUbicacion = '';
                this.data.custodio = '';
                if (this.campus) {
                    _.forEach(this.campus.get_campus, c => {
                        if (c.id == this.data.campus) {
                            this.pabellones = c;
                        }
                    });
                } else {
                    console.log("THERE IS NO A OBJECT")
                }

            },

            next(){

                _.forEach(this.campus.get_campus, c => {
                    if (c.id == this.data.campus) {
                        this.names.campus = c.campus;
                    }
                });
                this.names.sede = this.campus.sede;

                this.showComponent = true;
            },

            datosCustodio(payload){
                if (payload) {
                    this.data.custodio = payload;
                    this.init = false;
                    this.inventario = true;
                }
            }

        },

        computed: {

            showInfoComponent(){
                return Object.keys(this.data.sede &&
                        this.data.campus &&
                        this.data.pabellon &&
                        this.data.codigoUbicacion &&
                        this.data.piso.toString()).length != 0;
            }
        },


        watch: {
            showInfoComponent(){
                this.showInfoComponent === false ? this.showComponent = false : true
            }
        },
        components: {
            Info, Inventario
        }
    }
</script>
