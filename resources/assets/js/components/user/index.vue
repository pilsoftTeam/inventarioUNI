<template>
    <div>


        <!-- TAB NAVIGATION -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab1" role="tab" data-toggle="tab">Inventario</a></li>
            <li><a href="#tab2" role="tab" data-toggle="tab">Custodios</a></li>
        </ul>
        <!-- TAB CONTENT -->
        <div class="tab-content">
            <div class="active tab-pane fade in" id="tab1">
                <br>
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
                                    <select class="form-control" v-model="data.pabellon" @change="setPiso">
                                        <option value=""> -- Seleccione --</option>

                                        <option v-for="(key , item) in pabellones.pabellones"
                                                :value="key">
                                            {{ pabellones.campus }} -- Pabellon {{ key }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Piso</label>
                                    <select class="form-control" v-model="data.piso" @change="setCodigoUbicacion">
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
                    <div class="col-xs-18 col-sm-8 col-md-8 col-lg-8">
                        <div class="panel panel-default" v-if="showComponent">
                            <div class="panel-body">
                                <info :dataInventario="data" :names="names" @custodio="datosCustodio"></info>
                            </div>
                        </div>
                        <div v-else>
                            <h1 class="text-center"
                                style="margin-top: 25%">
                                Por favor llene los items
                            </h1>
                        </div>
                    </div>
                </div>
                <div v-if="inventario">
                    <inventario :dataInventario="data" @back="back"></inventario>
                </div>
            </div>
            <div class="tab-pane fade" id="tab2">
                <br>
                <custodios></custodios>
            </div>
        </div>


    </div>
</template>

<script>
    import _ from 'lodash'
    import Info from './dataInfo/index.vue'
    import Inventario from './inventario/inventario.vue'
    import Custodios from './../admin/custodios/index.vue'
    export default {
        mounted(){
            this.getDatos();
        },
        data () {
            return {
                sedes: '',
                sedesHechas: '',

                selector: [],

                campus: '',
                pabellones: '',

                data: {
                    sede: '',
                    campus: '',
                    pabellon: '',
                    piso: '',
                    codigoUbicacion: '',
                    custodio: '',
                    rutaImagenLayout: ''
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
                    this.sedes = r.data[0];
                    this.sedesHechas = r.data[1];
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
                    _.forEach(this.sedesHechas, h => {
                        if (h.idCampus === this.data.campus) {
                            this.selector.push(h)
                        }
                    })
                }

            },
            setPiso(){
                this.data.piso = '';
                this.data.codigoUbicacion = '';
            },
            setCodigoUbicacion(){
                this.data.codigoUbicacion = '';
            },
            back(){
                this.inventario = false;
                this.init = true;
            },

            next(){
                if (this.data.codigoUbicacion) {
                    axios.post('api/validar/inventario', this.data).then(r => {
                        if (Object.keys(r.data).length === 0 && r.data.constructor === Object) {
                            _.forEach(this.campus.get_campus, c => {
                                if (c.id == this.data.campus) {
                                    this.names.campus = c.campus;
                                }
                            });
                            this.names.sede = this.campus.sede;
                            this.showComponent = true;
                        } else {
                            alert('Sr(a) usuario. Este inventario ya aparece en nuestros registros como completo. Por favor intentelo de nuevo con otro')
                        }
                    }).catch(e => {
                        console.log(e)
                    });
                } else {
                    return false
                }

            },

            datosCustodio(payload){
                if (payload) {
                    this.data.custodio = payload.custodio;
                    if (payload.file.xhrResponse) {
                        this.data.rutaImagenLayout = JSON.parse(payload.file.xhrResponse.response);
                    } else {
                        this.data.rutaImagenLayout = null
                    }
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
            },
        },


        watch: {
            showInfoComponent(){
                this.showInfoComponent === false ? this.showComponent = false : true
            }
        },
        components: {
            Info, Inventario, Custodios
        }
    }
</script>
