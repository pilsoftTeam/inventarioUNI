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
                            <select class="form-control" v-model="data.sede">
                                <option value=""> -- Seleccione --</option>
                                <option :value="informacionSede.sede">
                                    {{informacionSede.sede}}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Campus</label>
                            <select class="form-control" v-model="data.campus">
                                <option value=""> -- Seleccione --</option>
                                <option :value="informacionSede.campus">
                                    {{informacionSede.campus}}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Pabellon</label>
                            <select class="form-control" v-model="data.pabellon">
                                <option value=""> -- Seleccione --</option>
                                <option :value="informacionSede.pabellon">
                                    {{informacionSede.pabellon}}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Piso</label>
                            <select class="form-control" v-model="data.piso">
                                <option value=""> -- Seleccione --</option>
                                <option v-for="piso in informacionSede.piso" :value="piso" :key="piso.id">
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

                    </div>
                </div>
            </div>
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                <div class="panel panel-default" v-if="showInfoComponent">
                    <div class="panel-body">
                        <info :dataInventario="data" @custodio="datosCustodio"></info>
                    </div>
                </div>
                <div v-else>
                    <h2 class="text-center">Por favor llene los items de la izquierda para continuar</h2>
                    <hr>
                    <br>
                    <img src="http://vps24413.inmotionhosting.com/~pilsof5/demodpp/public/img/Logo_Fortunato.png"
                         width="400"
                         height="300"
                         style="margin: 0 auto"
                         alt=""
                         class="img img-responsive">
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
        data () {
            return {
                informacionSede: {
                    sede: 'Casa Central - Iquique',
                    campus: 'Casa Central - Iquique-Genaro Gallo',
                    pabellon: 'Casa Central - Iquique-Playa Brava - P1',
                    piso: [1, 2, 3, 4, 5, 6, 7, 8]
                },
                data: {
                    sede: '',
                    campus: '',
                    pabellon: '',
                    piso: '',
                    codigoUbicacion: '',
                    custodio: ''
                },

                init: true,
                inventario: false

            }
        },
        computed: {

            showInfoComponent(){
                return Object.keys(this.data.sede && this.data.campus && this.data.pabellon && this.data.codigoUbicacion && this.data.piso.toString()).length != 0;
            }
        },

        methods: {
            datosCustodio(payload){
                if (payload) {
                    this.data.custodio = payload;
                    this.init = false;
                    this.inventario = true;
                }
            }
        },
        components: {
            Info, Inventario
        }
    }
</script>
